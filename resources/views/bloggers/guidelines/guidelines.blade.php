@extends('layouts.blogger')

@section('blogcontent')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">

    <h2 class="mb-4 text-primary text-center">Guidelines for {{ ucfirst($focus) }} Bloggers</h2>
    <hr class="mb-5">

    {{-- Introduction --}}
    @if(!empty($global['introduction']['content']))
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-info"><i class="bi bi-book me-2"></i>{{ $global['introduction']['title'] }}</h4>
            <p class="card-text">{{ $global['introduction']['content'] }}</p>
        </div>
    </div>
    @endif

    {{-- Mission --}}
    @if(!empty($global['mission']['content']))
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-success"><i class="bi bi-lightbulb me-2"></i>{{ $global['mission']['title'] }}</h4>
            <p class="card-text">{{ $global['mission']['content'] }}</p>
        </div>
    </div>
    @endif

    {{-- Who Can Publish --}}
    @if(!empty($global['who_can_publish']['content']))
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-warning"><i class="bi bi-people me-2"></i>{{ $global['who_can_publish']['title'] }}</h4>
            <p class="card-text">{{ $global['who_can_publish']['content'] }}</p>
        </div>
    </div>
    @endif

    {{-- Commitment --}}
    @if(!empty($global['commitment']['content']))
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-danger"><i class="bi bi-hand-thumbs-up me-2"></i>{{ $global['commitment']['title'] }}</h4>
            <p class="card-text">{{ $global['commitment']['content'] }}</p>
        </div>
    </div>
    @endif

    {{-- Content Quality Standards --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-primary"><i class="bi bi-patch-check me-2"></i>Content Quality Standards</h4>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h5 class="text-success"><i class="bi bi-check-circle me-1"></i>What We Encourage</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($baseRules['encourage'] ?? [] as $rule)
                            <li class="list-group-item border-0 ps-0"><i class="bi bi-star-fill text-warning me-2"></i>{{ $rule }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5 class="text-danger"><i class="bi bi-x-circle me-1"></i>What to Avoid</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($baseRules['avoid'] ?? [] as $rule)
                            <li class="list-group-item border-0 ps-0"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>{{ $rule }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright & Intellectual Property --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-secondary"><i class="bi bi-shield-lock me-2"></i>Copyright & Intellectual Property</h4>
            @if(!empty($copyright))
                @foreach($copyright as $line)
                    <p class="mb-1">{{ $line }}</p>
                @endforeach
            @else
                <p>Respect all copyrights and intellectual property rules.</p>
            @endif
        </div>
    </div>

    {{-- Special Guidelines for Focus --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-info"><i class="bi bi-gear-fill me-2"></i>Special Guidelines for {{ ucfirst($focus) }}</h4>
            <ul class="list-group list-group-flush mt-2">
                @foreach($focusRules as $rule)
                    <li class="list-group-item border-0 ps-0"><i class="bi bi-check-circle text-success me-2"></i>{{ $rule }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Politics ALWAYS --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-warning"><i class="bi bi-bank me-2"></i>Political / Civic Guidelines</h4>
            <ul class="list-group list-group-flush mt-2">
                @foreach($politicsRules as $rule)
                    <li class="list-group-item border-0 ps-0"><i class="bi bi-exclamation-circle text-danger me-2"></i>{{ $rule }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    @if(!empty($focusRules))
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title text-info">
                    <i class="bi bi-gear-fill me-2"></i>
                    {{ ucfirst(str_replace('-', ' ', $focus)) }} Guidelines
                </h4>

                <ul class="list-group list-group-flush mt-2">
                    @foreach($focusRules as $rule)
                        <li class="list-group-item border-0 ps-0">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            {{ $rule }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    {{-- FAQs --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-primary"><i class="bi bi-question-circle me-2"></i>FAQs</h4>
            <ul class="list-group list-group-flush mt-2">
                <li class="list-group-item border-0 ps-0"><i class="bi bi-info-circle text-info me-2"></i>Can I preview a blog before publishing?</li>
                <li class="list-group-item border-0 ps-0"><i class="bi bi-info-circle text-info me-2"></i>Do I need to meet a certain word count?</li>
                <li class="list-group-item border-0 ps-0"><i class="bi bi-info-circle text-info me-2"></i>What content is prohibited?</li>
                <li class="list-group-item border-0 ps-0"><i class="bi bi-info-circle text-info me-2"></i>How do I report issues or plagiarism?</li>
                <li class="list-group-item border-0 ps-0"><i class="bi bi-info-circle text-info me-2"></i>Who can I contact for support?</li>
            </ul>
        </div>
    </div>

</div>
@endsection
