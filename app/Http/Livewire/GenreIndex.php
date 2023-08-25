<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class GenreIndex extends Component
{
    use WithPagination;

    public $tmdbId;
    public $title;
    public $genreId;

    public $showModal = false;

    protected $rules = [
        'title' => 'required',
    ];

    public function generateGenresTv()
    {
        $loadGenresTv = Http::get('https://api.themoviedb.org/3/genre/tv/list?api_key='. env('TMDB_API_KEY') .'&language=en-US')->json();

        $genre = Genre::where('tmdb_id', $loadGenresTv['id'])->first();
        if (!$genre) {
            Genre::create([
                'tmdb_id'   => $loadGenresTv['id'],
                'title'     => $loadGenresTv['name'],
                'slug'      => Str::slug($loadGenresTv['name']),
            ]);
            $this->reset();
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre created']);
        } else {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Genre exisit']);
        }
    }

    public function generateGenresMovie()
    {
        $loadGenresMovie = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='. env('TMDB_API_KEY') .'&language=en-US')->json();

        foreach ($loadGenresMovie['genres'] as $data) {
            Genre::create([
                'tmdb_id'   => $data['id'],
                'title'     => $data['name'],
                'slug'      => Str::slug($data['name']),
            ]);
        }
        $this->reset();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Movie genres loaded successfully!']);
    }







    public function showEditModal($id)
    {
        $this->genreId = $id;
        $this->loadGenre();
        $this->showModal = true;
    }

    public function loadGenre()
    {
        $genre = Genre::findOrFail($this->genreId);
        $this->title = $genre->title;
    }

    public function update()
    {
        $this->validate();
        $genre = Genre::findOrFail($this->genreId);
        $genre->update([
            'title' => $this->title,
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre updated']);
        $this->reset();
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function delete($id)
    {
        Genre::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre deleted']);
        $this->reset();
    }


    public function render()
    {
        return view('livewire.genre-index', [
            'genres' => Genre::paginate(5)
        ]);
    }
}
