@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<main class="main py-3">
    <div class="container">
        <div class="row">
            <!-- @ include('components.sidebar') -->
            
            <div class="col-10">
                <h1>{{ $post->title }}</h1>
                <div class="post-meta mb-3">
                    @if($post->created_at)
                        <span class="text-muted">
                            {{ $post->created_at->format('d.m.Y H:i') }}
                        </span>
                    @endif
                    
                    @if($post->rate)
                        <span class="badge bg-primary ms-2">
                            Рейтинг: {{ $post->rate }}
                        </span>
                    @endif
                </div>
                
                <div class="post-content">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
