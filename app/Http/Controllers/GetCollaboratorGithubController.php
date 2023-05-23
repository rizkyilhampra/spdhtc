<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GetCollaboratorGithubController extends Controller
{
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
}
