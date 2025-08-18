/**
 * ProfileSelectManager - Robust Select2 State Management for Province/Regency Selection
 * 
 * Features:
 * - Clear state management
 * - Proper error handling
 * - Loading states
 * - Event-driven architecture
 * - Extensible design
 */

class ProfileSelectManager {
    constructor(options = {}) {
        this.options = {
            provinceSelector: '#provinsi',
            regencySelector: '#kota', 
            professionSelector: '#profesi',
            modalSelector: '#editProfileModal',
            theme: 'bootstrap-5',
            ...options
        };
        
        this.state = {
            isLoading: false,
            provinces: [],
            regencies: [],
            professions: [],
            selectedProvince: null,
            selectedRegency: null,
            selectedProfession: null,
            userProfile: null
        };
        
        this.elements = {};
        this.initialized = false;
        
        this.init();
    }
    
    /**
     * Initialize the manager
     */
    init() {
        if (this.initialized) {
            console.warn('ProfileSelectManager already initialized');
            return;
        }
        
        this.cacheElements();
        this.initializeSelect2();
        this.bindEvents();
        this.initialized = true;
        
        console.log('ProfileSelectManager initialized');
    }
    
    /**
     * Cache DOM elements
     */
    cacheElements() {
        this.elements = {
            province: document.querySelector(this.options.provinceSelector),
            regency: document.querySelector(this.options.regencySelector), 
            profession: document.querySelector(this.options.professionSelector),
            modal: document.querySelector(this.options.modalSelector)
        };
        
        // Validate elements exist
        Object.entries(this.elements).forEach(([key, element]) => {
            if (!element) {
                throw new Error(`Element not found: ${key}`);
            }
        });
    }
    
    /**
     * Initialize Select2 on all select elements
     */
    initializeSelect2() {
        const select2Config = {
            theme: this.options.theme,
            dropdownParent: $(this.options.modalSelector),
            allowClear: true,
            placeholder: function() {
                return $(this).data('placeholder');
            }
        };
        
        $(this.elements.province)
            .attr('data-placeholder', 'Pilih Provinsi')
            .select2(select2Config);
            
        $(this.elements.regency)
            .attr('data-placeholder', 'Pilih Kabupaten/Kota')
            .select2(select2Config);
            
        $(this.elements.profession)
            .attr('data-placeholder', 'Pilih Profesi')
            .select2(select2Config);
    }
    
    /**
     * Bind event handlers
     */
    bindEvents() {
        // Province selection change
        $(this.elements.province).on('select2:select', async (e) => {
            const provinceId = e.params.data.id;
            await this.handleProvinceChange(provinceId);
        });
        
        // Clear regency when province is cleared
        $(this.elements.province).on('select2:clear', () => {
            this.clearRegencyOptions();
            this.state.selectedProvince = null;
            this.state.selectedRegency = null;
        });
        
        // Track regency selection
        $(this.elements.regency).on('select2:select', (e) => {
            this.state.selectedRegency = e.params.data.id;
        });
        
        // Track profession selection
        $(this.elements.profession).on('select2:select', (e) => {
            this.state.selectedProfession = e.params.data.id;
        });
    }
    
    /**
     * Load initial data and populate selects
     */
    async loadInitialData(userData) {
        try {
            this.setLoadingState(true);
            this.state.userProfile = userData;
            
            // Load provinces and professions in parallel
            const [provinces, professions] = await Promise.all([
                this.fetchProvinces(),
                Promise.resolve(userData.profesi || []) // Professions from user data
            ]);
            
            this.state.provinces = provinces;
            this.state.professions = professions;
            
            // Populate selects
            this.populateProvinces();
            this.populateProfessions();
            
            // Set selected values from user profile
            if (userData.user.profile) {
                await this.setSelectedValues(userData.user.profile);
            }
            
        } catch (error) {
            this.handleError('Failed to load initial data', error);
        } finally {
            this.setLoadingState(false);
        }
    }
    
    /**
     * Handle province selection change
     */
    async handleProvinceChange(provinceId) {
        try {
            this.state.selectedProvince = provinceId;
            this.state.selectedRegency = null;
            
            // Clear and disable regency select
            this.clearRegencyOptions();
            this.setRegencyLoadingState(true);
            
            // Fetch regencies for selected province
            const regencies = await this.fetchRegencies(provinceId);
            this.state.regencies = regencies;
            
            // Populate regency options
            this.populateRegencies();
            
        } catch (error) {
            this.handleError('Failed to load regencies', error);
            this.clearRegencyOptions();
        } finally {
            this.setRegencyLoadingState(false);
        }
    }
    
    /**
     * Populate province options
     */
    populateProvinces() {
        const $select = $(this.elements.province);
        $select.empty();
        
        this.state.provinces.forEach(province => {
            const option = new Option(province.province, province.province_id, false, false);
            $select.append(option);
        });
        
        $select.prop('disabled', false).trigger('change.select2');
    }
    
    /**
     * Populate regency options
     */
    populateRegencies() {
        const $select = $(this.elements.regency);
        $select.empty();
        
        if (this.state.regencies.length === 0) {
            const option = new Option('Tidak ada data kabupaten/kota', '', false, false);
            option.disabled = true;
            $select.append(option).prop('disabled', true);
        } else {
            this.state.regencies.forEach(regency => {
                const option = new Option(regency.city_name, regency.city_id, false, false);
                $select.append(option);
            });
            $select.prop('disabled', false);
        }
        
        $select.trigger('change.select2');
    }
    
    /**
     * Populate profession options
     */
    populateProfessions() {
        const $select = $(this.elements.profession);
        $select.empty();
        
        this.state.professions.forEach(profession => {
            const option = new Option(profession, profession, false, false);
            $select.append(option);
        });
        
        $select.prop('disabled', false).trigger('change.select2');
    }
    
    /**
     * Set selected values from user profile
     */
    async setSelectedValues(profile) {
        // Set province
        if (profile.province) {
            $(this.elements.province).val(profile.province).trigger('change.select2');
            this.state.selectedProvince = profile.province;
            
            // Load regencies for the selected province
            if (profile.city) {
                try {
                    const regencies = await this.fetchRegencies(profile.province);
                    this.state.regencies = regencies;
                    this.populateRegencies();
                    
                    // Set regency after populating options
                    $(this.elements.regency).val(profile.city).trigger('change.select2');
                    this.state.selectedRegency = profile.city;
                } catch (error) {
                    console.warn('Could not load regencies for selected province:', error);
                }
            }
        }
        
        // Set profession
        if (profile.profession) {
            $(this.elements.profession).val(profile.profession).trigger('change.select2');
            this.state.selectedProfession = profile.profession;
        }
    }
    
    /**
     * Clear regency options and reset state
     */
    clearRegencyOptions() {
        const $select = $(this.elements.regency);
        $select.empty();
        
        const option = new Option('Pilih provinsi terlebih dahulu', '', false, false);
        option.disabled = true;
        $select.append(option).prop('disabled', true).trigger('change.select2');
        
        this.state.regencies = [];
        this.state.selectedRegency = null;
    }
    
    /**
     * Set loading state for all selects
     */
    setLoadingState(isLoading) {
        this.state.isLoading = isLoading;
        
        const $elements = [
            $(this.elements.province),
            $(this.elements.regency),
            $(this.elements.profession)
        ];
        
        $elements.forEach($element => {
            if (isLoading) {
                $element.empty().append(new Option('Memuat...', '', false, false))
                       .prop('disabled', true);
            }
        });
    }
    
    /**
     * Set loading state specifically for regency select
     */
    setRegencyLoadingState(isLoading) {
        const $select = $(this.elements.regency);
        
        if (isLoading) {
            $select.empty().append(new Option('Memuat kabupaten/kota...', '', false, false))
                   .prop('disabled', true);
        }
    }
    
    /**
     * Fetch provinces from API
     */
    async fetchProvinces() {
        const response = await $.ajax({
            url: '/edit-profile',
            method: 'GET',
            dataType: 'json'
        });
        
        return response.provinsi || [];
    }
    
    /**
     * Fetch regencies for a province
     */
    async fetchRegencies(provinceId) {
        if (!provinceId) {
            throw new Error('Province ID is required');
        }
        
        const response = await $.ajax({
            url: `/edit-profile/lokasi/kota/${provinceId}`,
            method: 'GET',
            dataType: 'json'
        });
        
        return response || [];
    }
    
    /**
     * Handle errors consistently
     */
    handleError(message, error) {
        console.error(`ProfileSelectManager: ${message}`, error);
        
        // Show user-friendly error message
        if (typeof swalError === 'function' && error.responseJSON) {
            swalError(error.responseJSON);
        } else {
            // Fallback error handling
            console.error('Error details:', error);
        }
    }
    
    /**
     * Get current form values
     */
    getFormValues() {
        return {
            province: this.state.selectedProvince,
            regency: this.state.selectedRegency,
            profession: this.state.selectedProfession
        };
    }
    
    /**
     * Validate form values
     */
    validate() {
        const errors = [];
        
        if (!this.state.selectedProvince) {
            errors.push('Provinsi harus dipilih');
        }
        
        if (!this.state.selectedRegency) {
            errors.push('Kabupaten/Kota harus dipilih'); 
        }
        
        if (!this.state.selectedProfession) {
            errors.push('Profesi harus dipilih');
        }
        
        return {
            isValid: errors.length === 0,
            errors
        };
    }
    
    /**
     * Reset all selects to initial state
     */
    reset() {
        this.clearRegencyOptions();
        
        $(this.elements.province).val(null).trigger('change.select2');
        $(this.elements.profession).val(null).trigger('change.select2');
        
        this.state.selectedProvince = null;
        this.state.selectedRegency = null;
        this.state.selectedProfession = null;
    }
    
    /**
     * Destroy the manager and cleanup
     */
    destroy() {
        // Remove event listeners
        $(this.elements.province).off('select2:select select2:clear');
        $(this.elements.regency).off('select2:select');
        $(this.elements.profession).off('select2:select');
        
        // Destroy Select2 instances
        $(this.elements.province).select2('destroy');
        $(this.elements.regency).select2('destroy');
        $(this.elements.profession).select2('destroy');
        
        this.initialized = false;
        console.log('ProfileSelectManager destroyed');
    }
}

// Export for use in profile-modal.js
window.ProfileSelectManager = ProfileSelectManager;