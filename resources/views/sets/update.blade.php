@extends('base')

@section('content')
    <div>
        <form action="{{ route('sets.update', $set) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('sets.partials.update-meta')

            <div class="mb-8">
                <h3 class="mb-2 font-bold">Fotos</h3>
                <div id="image_wrapper">
                    @foreach ($set->documents as $image)
                        @include('sets.partials.update-image', [
                            'datenow' => time() . '_' . $loop->index,
                            'img' => $image
                        ])
                    @endforeach
                </div>
            </div>

            @include('sets.partials.update-actions')
        </form>
    </div>

    <form action="{{ route('sets.destroy', [$set]) }}" method="post">
        @csrf
        @method('delete')
        <x-buttons.delete/>
    </form>

    <template id="image_template">
        @include('sets.partials.update-image')
    </template>

    @include('sets.partials.update-scripts')

@endsection