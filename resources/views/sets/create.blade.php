@extends('base')

@section('content')
    <div class="overflow-x-hidden">
        <form action="{{ route('sets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('sets.partials.update-meta')

            <div class="mb-8">
                <h3 class="mb-2 font-bold">Fotos</h3>
                <div id="image_wrapper"></div>
            </div>

            @include('sets.partials.update-actions')
        </form>
    </div>

    <template id="image_template">
        @include('sets.partials.update-image')
    </template>

    @include('sets.partials.update-scripts')

@endsection