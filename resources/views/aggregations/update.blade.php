@extends('base')

@section('content')
    <div class="overflow-x-hidden">
        <form action="{{ route('aggregations.update', $aggregation) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('aggregations.partials.update-meta')

            <div class="mb-8">
                <h3 class="mb-2 font-bold">Fotos</h3>
                <div id="image_wrapper">
                    @foreach ($aggregation->documents as $image)
                        @include('aggregations.partials.update-image', [
                            'datenow' => time() . '_' . $loop->index,
                            'img' => $image
                        ])
                    @endforeach
                </div>
            </div>

            @include('aggregations.partials.update-actions')
        </form>
    </div>

    <form action="{{ route('aggregations.destroy', [$aggregation]) }}" method="post">
        @csrf
        @method('delete')
        <x-buttons.delete/>
    </form>

    <template id="image_template">
        @include('aggregations.partials.update-image')
    </template>

    @include('aggregations.partials.update-scripts')

@endsection
