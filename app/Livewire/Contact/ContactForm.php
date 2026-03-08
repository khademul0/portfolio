<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    protected function rules(): array
    {
        return [
            'name' => ['required','string','max:120'],
            'email' => ['required','email','max:190'],
            'subject' => ['nullable','string','max:190'],
            'message' => ['required','string','min:10','max:5000'],
        ];
    }

    public function submit()
    {
        $this->validate();

        $submission = ContactSubmission::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject ?: 'Portfolio Contact',
            'message' => $this->message,
            'ip_hash' => request()->ip() ? hash('sha256', request()->ip() . config('app.key')) : null,
            'user_agent' => substr((string) request()->userAgent(), 0, 255),
        ]);

        // Send mail (Step 7 will make the destination editable via admin settings)
        Mail::raw(
            "From: {$submission->name} ({$submission->email})\n\nSubject: {$submission->subject}\n\n{$submission->message}",
            fn ($m) => $m->to(config('mail.from.address') ?: 'admin@example.com')->subject("New Portfolio Message: {$submission->subject}")
        );

        $this->reset(['name','email','subject','message']);

        $this->dispatch('contact-sent');
        session()->flash('success', 'Message sent successfully. I will reply soon!');
    }

    public function render()
    {
        return view('livewire.contact.contact-form');
    }
}
