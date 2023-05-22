<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AdminController extends Controller
{
    public function beranda()
    {
        $loginDuration = $this->LoginDuration();

        return view('admin.beranda', compact('loginDuration'));
    }

    public function getCollaborators()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.github.com/repos/rizkyilhampra/spdhtc/collaborators', [
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                    'Authorization' => 'token ' . env('GITHUB_PERSONAL_ACCESS_TOKEN'),
                ],
            ]);
            $collaborators = json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            $collaborators = [];
        }
        return $collaborators;
    }

    public function gejala()
    {
        return view('admin.gejala');
    }
}
