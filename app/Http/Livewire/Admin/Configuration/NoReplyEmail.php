<?php

namespace App\Http\Livewire\Admin\Configuration;

use App\Models\Configuration;
use Livewire\Component;

class NoReplyEmail extends Component
{

    public $MAIL_MAILER;
    public $MAIL_HOST;
    public $MAIL_PORT;
    public $MAIL_USERNAME;
    public $MAIL_PASSWORD;
    public $MAIL_ENCRYPTION;
    public $MAIL_FROM_ADDRESS;
    public $MAIL_FROM_NAME;

    public function mount()
    {
        $config = Configuration::where('config_type', 'NoReplyEmail')
            ->first();

        $value = json_decode($config->config_value);

        if (!empty($config)) {
            $this->MAIL_MAILER = $value->MAIL_MAILER;
            $this->MAIL_HOST = $value->MAIL_HOST;
            $this->MAIL_PORT = $value->MAIL_PORT;
            $this->MAIL_USERNAME = $value->MAIL_USERNAME;
            $this->MAIL_PASSWORD = $value->MAIL_PASSWORD;
            $this->MAIL_ENCRYPTION = $value->MAIL_ENCRYPTION;
            $this->MAIL_FROM_ADDRESS = $value->MAIL_FROM_ADDRESS;
            $this->MAIL_FROM_NAME = $value->MAIL_FROM_NAME;
        }
    }

    public function config_changed()
    {

        $config = Configuration::where('config_type', 'NoReplyEmail')
            ->first();

        $value = json_encode([
            'MAIL_MAILER' => $this->MAIL_MAILER,
            'MAIL_HOST' => $this->MAIL_HOST,
            'MAIL_PORT' => $this->MAIL_PORT,
            'MAIL_USERNAME' => $this->MAIL_USERNAME,
            'MAIL_PASSWORD' => $this->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' =>  $this->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $this->MAIL_FROM_ADDRESS,
            'MAIL_FROM_NAME' => $this->MAIL_FROM_NAME,
        ]);

        $config->config_value = $value;
        $config->save();

        session()->flash('message', 'Item successfully updated.');
    }

    public function render()
    {
        return view('livewire.admin.configuration.no-reply-email');
    }
}
