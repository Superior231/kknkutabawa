<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Project as ModelsProject;
use Livewire\Component;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $numberOfPaginatorsRendered = [];
    public $search = '';

    // Filter
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $currentFilter = 'Terbaru';

    // Category
    public $categoryFilters = [];
    public $sortedCategoryFilters = [];


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == 'terbaru') {
            $this->sortField = 'created_at';
            $this->sortDirection = 'desc';
            $this->currentFilter = 'Terbaru';
        } elseif ($field == 'terlama') {
            $this->sortField = 'created_at';
            $this->sortDirection = 'asc';
            $this->currentFilter = 'Terlama';
        } elseif ($field == 'az') {
            $this->sortField = 'title';
            $this->sortDirection = 'asc';
            $this->currentFilter = 'A - Z';
        }

        $this->resetPage();
    }


    public function render()
    {
        $query = ModelsProject::where('title', 'like', '%'.$this->search.'%');
        $categories = Category::orderBy('name', 'asc')->get();

        if (!empty($this->categoryFilters)) {
            $query->where(function ($query) {
                foreach ($this->categoryFilters as $category) {
                    $query->where('category', 'like', '%' . $category . '%');
                }
            });
        }

        $projects = $query->orderBy($this->sortField, $this->sortDirection)->paginate(6);

        // Mengurutkan categoryFilters secara alfabetis
        $this->sortedCategoryFilters = $this->categoryFilters;
        sort($this->sortedCategoryFilters);

        return view('livewire.project', [
            'projects' => $projects,
            'categories' => $categories,
            'currentFilter' => $this->currentFilter,
            'sortedCategoryFilters' => $this->sortedCategoryFilters
        ]);
    }
}
