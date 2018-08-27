@extends('layouts.app')

@section('content')
    <section class="home-slider"></section>
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center py-3">
                        <h3>Feedback</h3>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>What you feel about or products</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('feedback.save') }}" aria-label="{{ __('Register') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="feed_type">Feedback type</label>
                                    <select class="form-control" name="feed_type" id="feed_type">
                                        <option selected disabled>-- Type  of Feedback -- </option>
                                        <option value="1">Complaint</option>
                                        <option value="2">Suggestion</option>
                                        <option value="3">Appraisal</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message">{{ __('') }}</label>

                                    <textarea class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" required></textarea>

                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection