<?php

namespace App\Controllers;

use App\Models\OfferModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class OfferResponseController extends BaseController
{
    protected OfferModel $offerModel;

    public function __construct()
    {
        $this->offerModel = new OfferModel();
    }

    public function show(string $token): ResponseInterface
    {
        $offer = $this->findOfferByToken($token);

        return view('public/offer_response', [
            'offer' => $offer,
            'token' => $token,
            'responseStatus' => session()->getFlashdata('response_status'),
            'responseMessage' => session()->getFlashdata('response_message'),
        ]);
    }

    public function respond(string $token, string $action)
    {
        $offer = $this->findOfferByToken($token);
        $action = strtolower($action);

        if (!in_array($action, ['accept', 'reject'], true)) {
            return $this->redirectWithMessage($token, 'error', 'Ongeldige keuze.');
        }

        if (!in_array($offer['status'], ['sent', 'draft', 'accepted', 'rejected'], true)) {
            return $this->redirectWithMessage($token, 'error', 'Deze offerte kan momenteel niet worden bijgewerkt.');
        }

        $newStatus = $action === 'accept' ? 'accepted' : 'rejected';

        if ($offer['status'] === $newStatus) {
            return $this->redirectWithMessage(
                $token,
                'info',
                $newStatus === 'accepted'
                    ? 'U heeft deze offerte al geaccepteerd.'
                    : 'U heeft deze offerte al afgewezen.'
            );
        }

        $this->offerModel->update($offer['id'], [
            'status' => $newStatus,
            'client_response_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->redirectWithMessage(
            $token,
            'success',
            $newStatus === 'accepted'
                ? 'Bedankt! U heeft de offerte succesvol geaccepteerd.'
                : 'Bedankt voor uw reactie. De offerte is geweigerd.'
        );
    }

    protected function findOfferByToken(string $token): array
    {
        $offer = $this->offerModel->where('client_response_token', $token)->first();

        if (!$offer) {
            throw PageNotFoundException::forPageNotFound('Deze offerte kon niet worden gevonden.');
        }

        return $offer;
    }

    protected function redirectWithMessage(string $token, string $status, string $message): RedirectResponse
    {
        return redirect()
            ->to('/offer/respond/' . $token)
            ->with('response_status', $status)
            ->with('response_message', $message);
    }
}
