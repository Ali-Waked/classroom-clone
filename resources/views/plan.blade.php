<x-layout>
    @if (Session::has('info'))
        <div class="info">{{ Session::get('info') }}</div>
    @endif
    <section class="plan">
        <h2>{{ __('Plans') }}</h2>
        <div>
            <div class="plan-container">
                @foreach ($plans as $plan)
                    <div class="plan-card {{ !$plan->featured ?: 'active' }}">
                        <div class="plan-name">
                            {{ $plan->name }}
                        </div>
                        <div class="price">
                            <span>${{ $plan->price }}</span>
                            <span>/mo</span>
                        </div>
                        <div class="feature">
                            @foreach ($plan->features as $feature)
                            @endforeach
                            <span>{{ $feature->name }}</span>
                            <span>{{ $feature->code }}</span>
                        </div>
                        <form action="{{ route('subscripte.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <input type="hidden" name="period" value="3">
                            <button type="submit">{{ __('Subscribe') }}</button>
                        </form>
                    </div>
                @endforeach
                {{-- <div class="plan-card active">
                    <div class="plan-name">
                        Free Plan
                    </div>
                    <div class="price">
                        <span>$0</span>
                        <span>/mo</span>
                    </div>
                    <div class="feature">
                        <span>Classroom #:1</span>
                        <span>Student Per Classroom: 10</span>
                    </div>
                    <form action="" method="">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
                <div class="plan-card">
                    <div class="plan-name">
                        Free Plan
                    </div>
                    <div class="price">
                        <span>$0</span>
                        <span>/mo</span>
                    </div>
                    <div class="feature">
                        <span>Classroom #:1</span>
                        <span>Student Per Classroom: 10</span>
                    </div>
                    <form action="" method="">
                        <button type="submit">Subscribe</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </section>
</x-layout>
