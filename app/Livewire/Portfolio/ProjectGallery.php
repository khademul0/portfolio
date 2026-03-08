<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectGallery extends Component
{
    use WithPagination;

    public ?string $category = null;

    protected $queryString = ['category' => ['except' => null]];

    public function setCategory(?string $slug): void
    {
        $this->category = $slug;
        $this->resetPage();
    }

    public function render()
    {
        $categories = ProjectCategory::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        $projects = Project::query()
            ->where('is_published', true)
            ->when($this->category, function ($q) {
                $q->whereHas('category', fn($cq) => $cq->where('slug', $this->category));
            })
            ->latest()
            ->paginate(9);

        return view('livewire.portfolio.project-gallery', compact('categories', 'projects'));
    }
}
