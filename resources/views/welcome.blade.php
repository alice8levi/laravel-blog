@extends('layouts/main')

@section ('title', 'Home page')

@section('content')
<main class="main py-3">
    <div class="container">
        <div class="row">
            @if(file_exists(resource_path('views/components/sidebar.blade.php')))
                @include('components.sidebar')
            @endif
            
            <div class="col-10">
                <h3>{{ $header ?? 'Все записи' }}</h3>
                
                @forelse($posts as $post)
                    <div class="card mb-3 post-card">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-body">
                                <a href="{{ route('posts.show', $post) }} ">                                       
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                    </a> 
                                    <p class="card-text">{{ $post->excerpt }}</p>
                                    @if($post->created_at)
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                Опубликовано: {{ $post->created_at->format('d.m.Y') }}
                                            </small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">Записи не найдены</div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection