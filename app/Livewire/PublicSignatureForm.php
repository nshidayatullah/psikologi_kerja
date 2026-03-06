<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SurveySession;

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

        if ($type === 'pic1') {
            $this->signerName = $this->session->pic1_name ?: 'M. Hidayatullah';
            $this->signerRole = $this->session->pic1_role ?: 'Paramedic';
        } elseif ($type === 'pic2') {
            $this->signerName = $this->session->pic2_name ?: 'Junardi';
            $this->signerRole = $this->session->pic2_role ?: 'Paramedic';
        } elseif ($type === 'reviewer') {
            $this->signerName = $this->session->reviewer_name ?: 'dr. Haamim Sajdah S';
            $this->signerRole = $this->session->reviewer_role ?: 'Dokter Perusahaan';
        } else {
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
