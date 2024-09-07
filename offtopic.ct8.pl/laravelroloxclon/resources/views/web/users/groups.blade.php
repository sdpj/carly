<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

@extends('layouts.default', [
    'title' => "{$user->username}'s Groups"
])

@section('content')
    <h3>{{ $user->username }}'s Groups</h3>
    <div class="card">
        <div class="card-body" @if ($groups->count() > 0) style="padding-bottom:0;" @endif>
            <div class="row">
                @forelse ($groups as $group)
                    <div class="col-6 col-md-2">
                        <div class="card text-center" style="border:none;">
                            <a href="{{ route('groups.view', [$group->id, $group->slug()]) }}">
                                <img src="{{ $group->thumbnail() }}">
                                <div class="text-truncate mt-1">{{ $group->name }}</div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col text-center">
                        <i class="fas fa-frown text-warning mb-2" style="font-size:50px;"></i>
                        <div>This user is not in any groups.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{ $groups->onEachSide(1) }}
@endsection
