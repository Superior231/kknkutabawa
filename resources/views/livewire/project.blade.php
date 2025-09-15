<div>
    <div class="gap-2 actions d-flex justify-content-between">
        <!-- Filters -->
        <div class="gap-2 container-filters d-flex position-relative">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">Kategori</button>
                <ul class="dropdown-menu dropdown-menu-lg-start">
                    <div class="categories" style="max-height: 300px; overflow-y: auto;">
                        @foreach ($categories as $category)
                            <li>
                                <label class="dropdown-item" style="cursor: pointer;">
                                    <input type="checkbox" wire:model.live="categoryFilters" value="{{ $category->name }}"> {{ $category->name }}
                                </label>
                            </li>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>

        <!-- Search -->
        <div class="search-box">
            <i class='bx bx-search'></i>
            <input class="ms-0 ps-1" type="search" id="search" placeholder="Search..." autocomplete="off"  wire:model.live="search" style="outline: none !important; border: none;">
            <div class="dropdown dropup">
                <a class="p-0 m-0 d-flex align-items-center justify-content-center text-decoration-none" style="cursor: pointer;" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Filter">
                    <i class='p-0 m-0 bx bx-slider'></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownMenuLink">
                    <li><a href="#" class="dropdown-item {{ $currentFilter == 'Terbaru' ? 'bg-primary text-light' : '' }}" wire:click.prevent="sortBy('terbaru')" style="cursor: pointer;">Terbaru</a></li>
                    <li><a href="#" class="dropdown-item {{ $currentFilter == 'Terlama' ? 'bg-primary text-light' : '' }}" wire:click.prevent="sortBy('terlama')" style="cursor: pointer;">Terlama</a></li>
                    <li><a href="#" class="dropdown-item {{ $currentFilter == 'A - Z' ? 'bg-primary text-light' : '' }}" wire:click.prevent="sortBy('az')" style="cursor: pointer;">A - Z</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-2 category">
        @foreach ($sortedCategoryFilters as $filter)
            @php
                $category = trim($filter);
                $badgeClass = match ($category) {
                    'Ekonomi' => 'bg-ekonomi',
                    'Jati Diri' => 'bg-jatidiri',
                    'Kesehatan' => 'bg-kesehatan',
                    'Lingkungan' => 'bg-lingkungan',
                    'Pendidikan' => 'bg-pendidikan',
                    'Unggulan' => 'bg-unggulan',
                    default => 'bg-default',
                };
        
                $iconClass = match ($category) {
                    'Ekonomi' => 'fa-dollar-sign',
                    'Jati Diri' => 'fa-people-group',
                    'Kesehatan' => 'fa-heart-pulse',
                    'Lingkungan' => 'fa-leaf',
                    'Pendidikan' => 'fa-graduation-cap',
                    'Unggulan' => 'fa-thumbs-up',
                    default => 'fa-circle-question',
                };
            @endphp
            <p class="badge {{ $badgeClass }}">
                <i class="fa-solid {{ $iconClass }}"></i> {{ $category }}
            </p>
        @endforeach    
    </div>

    <div class="pt-0 mt-0 mb-5 row g-3 g-md-4 mt-lg-2">
        @forelse ($projects as $item)
            <div class="mb-3 col-md-4 mb-md-0">
                <div class="card h-100">
                    <a href="{{ route('show.project', $item->slug) }}" class="project position-relative h-100 text-decoration-none">
                        <div class="thumbnail">
                            <img src="{{ url('storage/thumbnails/' . $item->thumbnail) }}" alt="thumbnail" class="mb-3" style="width: 100%">
                        </div>
                        <div class="mt-2 mb-3 category fs-7">
                            @foreach (explode(',', $item->category) as $categories)
                                @php
                                    $category = trim($categories);
                                    $badgeClass = match ($category) {
                                        'Ekonomi' => 'bg-ekonomi',
                                        'Jati Diri' => 'bg-jatidiri',
                                        'Kesehatan' => 'bg-kesehatan',
                                        'Lingkungan' => 'bg-lingkungan',
                                        'Pendidikan' => 'bg-pendidikan',
                                        'Unggulan' => 'bg-unggulan',
                                        default => 'bg-default',
                                    };
                            
                                    $iconClass = match ($category) {
                                        'Ekonomi' => 'fa-dollar-sign',
                                        'Jati Diri' => 'fa-people-group',
                                        'Kesehatan' => 'fa-heart-pulse',
                                        'Lingkungan' => 'fa-leaf',
                                        'Pendidikan' => 'fa-graduation-cap',
                                        'Unggulan' => 'fa-thumbs-up',
                                        default => 'fa-circle-question',
                                    };
                                @endphp
                            
                                <p class="badge {{ $badgeClass }}">
                                    <i class="fa-solid {{ $iconClass }}"></i> {{ $category }}
                                </p>
                            @endforeach                        
                        </div>
                        <h4 class="mb-3 project-title">{{ $item->title }}</h4>
                    </a>
                    <hr class="bg-secondary">
                    <div class="footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('show.profile', $item->user->slug) }}" class="gap-1 author d-flex align-items-center">
                            <div class="gap-0 d-flex align-items-center">
                                <div class="avatar" style="width: 30px; height: 30px;">
                                    @if (!empty($item->user->avatar))
                                        <img class="img" src="{{ asset('storage/avatars/' . $item->user->avatar) }}" alt="avatar">
                                    @else
                                        <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($item->user->fullname) }}">
                                    @endif
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <span class="py-0 my-0 username text-color fw-semibold fs-7">{{ $item->user->fullname }}</span>
                                </div>
                            </div>
                        </a>
                        <p class="mb-0 text-secondary fs-7">{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
            </div>

        @empty
            <div class="d-flex justify-content-center align-items-center">
                <p class="fs-4 text-dark">Project tidak ada.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-container d-flex justify-content-center">
        {{ $projects->links() }}
    </div>
</div>
