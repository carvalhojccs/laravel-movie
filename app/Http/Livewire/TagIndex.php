<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class TagIndex extends Component
{
    public $showTagModal = false;

    public $name = '';

    public $tag_id = '';

    public $tags = [];

    public function mount()
    {
        $this->tags = Tag::all();
    }

    public function showCreateModal()
    {
        $this->showTagModal = true;
    }

    public function showEditModal($tag_id)
    {
        $this->reset(['name']);
        $this->tag_id = $tag_id;
        $tag = Tag::find($tag_id);
        $this->name = $tag->tag_name;
        $this->showTagModal = true;
    }

    public function update()
    {
        $tag = Tag::findOrFail($this->tag_id);
        $tag->update([
            'tag_name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->reset();
        $this->tags = Tag::all();
        $this->showTagModal = false;
    }

    public function create()
    {
        Tag::create([
            'tag_name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->reset();
        $this->tags = Tag::all();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Tag created successfully']);
    }

    public function delete($tag_id)
    {
        $tag = Tag::findOrFail($tag_id);
        $tag->delete();
        $this->reset();
        $this->tags = Tag::all();
    }



    public function closeTagModal()
    {
        $this->showTagModal = false;
    }

    public function render()
    {
        return view('livewire.tag-index');
    }
}
