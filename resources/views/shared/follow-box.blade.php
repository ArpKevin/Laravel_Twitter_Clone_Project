<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Top Users</h5>
    </div>
    <div class="card-body">
        @foreach ($topUsers as $topUser)
            <div class="hstack gap-2 mb-3">
                <div class="avatar">
                    <a href="{{ route('users.show', $topUser->id) }}"><img style="width:50px" class="avatar-img rounded-circle"
                            src="{{ $topUser->getImageURL() }}" alt="{{ $topUser->name }} Avatar"></a>
                </div>
                <div class="overflow-hidden">
                    <a class="h6 mb-0" href="{{ route('users.show', $topUser->id) }}">{{ $topUser->name }}</a>
                    <p class="mb-0 small text-truncate">{{ $topUser->email }}</p>
                </div>
                <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                    </i></a>
            </div>
        @endforeach
    </div>
</div>
