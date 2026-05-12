<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ContactMessage;
use App\Models\Media;

class ContactForm extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $subject;
    public $message;
    public $media_id;
    public $photo;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'photo' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        // No data needed on mount
    }

    public function submit()
    {
        $this->validate();
        
        $media_id = null;
        if ($this->photo) {
            try {
                $path = $this->photo->store('cms', 'public');
                $media = new Media([
                    'original_name' => $this->photo->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $this->photo->getMimeType(),
                    'size' => $this->photo->getSize(),
                ]);
                $media->save();
                $media_id = $media->id;
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to upload file. Please try again.');
                return;
            }
        }

        try {
            ContactMessage::create([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'message' => $this->message,
                'media_id' => $media_id
            ]);
            
            session()->flash('message', 'Your message has been sent successfully.');
            $this->reset(['name','email','subject','message','photo','media_id']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send message. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
?>
```
