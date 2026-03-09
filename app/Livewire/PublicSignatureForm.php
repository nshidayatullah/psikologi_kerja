<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SurveySession;
use App\Models\Signer;

class PublicSignatureForm extends Component
{
    public $uuid;
    public $type;
    public $session;
    public $signature;
    public $isSubmitted = false;
    public $signerName;
    public $signerRole;

    public function mount($uuid, $type)
    {
        $this->uuid = $uuid;
        $this->type = $type;
        $this->session = SurveySession::where('uuid', $uuid)->firstOrFail();

        $signer = Signer::where('type', $this->type)->first();
        $this->signerName = $this->session->{"{$this->type}_name"} ?: ($signer->name ?? '');
        $this->signerRole = $this->session->{"{$this->type}_role"} ?: ($signer->role ?? '');

        if (!$this->signerName && !$this->signerRole && !$signer) {
            abort(404);
        }
    }

    public function saveSignature($signatureData)
    {
        $this->signature = $signatureData;

        if ($this->type === 'pic1') {
            $this->session->update(['pic1_signature' => $this->signature]);
        } elseif ($this->type === 'pic2') {
            $this->session->update(['pic2_signature' => $this->signature]);
        } elseif ($this->type === 'reviewer') {
            $this->session->update(['reviewer_signature' => $this->signature]);
        }

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.public-signature-form');
    }
}
