{{-- @extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
@endsection --}}
@extends('frontend.messenger.template')

@section('title', $title)

@section('messenger-content')
<div class="row">
    <div class="col-lg-12">
        <div class="list-group">
            @forelse($topics as $topic)
                <div class="row list-group-item d-flex">
                    <div class="col-lg-4">
                        <a href="{{ route('frontend.messenger.showMessages', [$topic->id]) }}">
                            @php($receiverOrCreator = $topic->receiverOrCreator())
                                @if($topic->hasUnreads())
                                    <strong>
                                        {{ $receiverOrCreator !== null ? $receiverOrCreator->email : '' }}
                                    </strong>
                                @else
                                    {{ $receiverOrCreator !== null ? $receiverOrCreator->email : '' }}
                                @endif
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <a href="{{ route('frontend.messenger.showMessages', [$topic->id]) }}">
                            @if($topic->hasUnreads())
                                <strong>
                                    {{ $topic->subject }}
                                </strong>
                            @else
                                {{ $topic->subject }}
                            @endif
                        </a>
                    </div>
                    <div class="col-lg-2 text-right">{{ $topic->created_at->diffForHumans() }}</div>
                    <div class="col-lg-1 text-center">
                        <form action="{{ route('frontend.messenger.destroyTopic', [$topic->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                    </div>
                </div>
                @empty
                <div class="row list-group-item">
                    {{ trans('global.you_have_no_messages') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection