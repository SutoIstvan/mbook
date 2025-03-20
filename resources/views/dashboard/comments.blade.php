@extends('layouts.dashboard')

@section('content')
    <section class="process-ca section-padding bg-light radius-20 mt-15 ontop">
        <div class="sec-head mb-40">
            <div class="row">
                <div class="col-lg-12 md-mb15 md-mt35">
                    <h4>{{ __('Comments') }}</h4>
                </div>
            </div>
        </div>

        <div class="">
            <div class="rounded-lg overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 largecase tracking-wider">Dátum</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 largecase tracking-wider">Név</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 largecase tracking-wider">Megjegyzés</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 largecase tracking-wider">Állapot</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 largecase tracking-wider">Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $comment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                    {{ $comment->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap ">
                                    {{ $comment->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $comment->content }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($comment->status === 'pending')
                                        <span class="badge bg-warning text-dark">Moderálás alatt</span>
                                    @elseif($comment->status === 'approved')
                                        <span class="badge bg-success">Jóváhagyva</span>
                                    @else
                                        <span class="badge bg-danger">Elutasítva</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="d-flex gap-2">
                                        @if($comment->status === 'pending')
                                            <form action="{{ route('comments.approve', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    Jóváhagyni
                                                </button>
                                            </form>
                                            {{-- <form action="{{ route('comments.reject', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Отклонить
                                                </button>
                                            </form> --}}
                                        @endif
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('Вы уверены?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                Töröl
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                    Még nincsenek hozzászólások
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4">
                    {{ $comments->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>


    </section>

    <!-- ==================== SAVE BUTTON ==================== -->

    <section class="numbers-ca">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-60">
                    <button type="submit" class="butn butn-md butn-bord butn-rounded disabled">
                        <span class="text">
                            {{ __('Save changes') }}
                        </span>

                        <span class="icon ">
                            <i class="fa-regular fa-save"></i>
                        </span>

                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
