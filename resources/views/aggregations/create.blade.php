@extends('base')

@section('content')
    <div class="overflow-x-hidden">
        <form action="{{ route('aggregations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('aggregations.partials.update-meta')

            <div class="mb-8">
                <h3 class="mb-2 font-bold">Fotos</h3>
                <div id="image_wrapper"></div>
            </div>

            @include('aggregations.partials.update-actions')
        </form>
    </div>

    <template id="image_template">
        @include('aggregations.partials.update-image')
    </template>

    @include('aggregations.partials.update-scripts')

@endsection
