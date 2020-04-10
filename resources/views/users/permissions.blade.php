@extends('layouts.app')

@section('title_full', __('User Permissions').' - '.$user->first_name.' '.$user->last_name)

@section('sidebar')
    @include('partials/sidebar_menu_toggle')
    @include('users/sidebar_menu')
@endsection

@section('content')
    <div class="section-heading">
        {{ __('Permissions') }}
    </div>

    @include('partials/flash_messages')

    <div class="row-container">
        <div class="row">
            <div class="col-xs-12">
                <h3> {{ __(':first_name has access to the selected mailboxes:', ['first_name' => $user->first_name]) }}</h3>
            </div>
            <div class="col-md-11 col-lg-9">
                <form method="POST" action="">
                    {{ csrf_field() }}

                    @if ($user->isAdmin())
                        <p>
                            {{ __(':first_name is an administrator and has access to all mailboxes', ['first_name' => $user->first_name]) }}
                        </p>
                    @else
                        <table class="table" id="permissions-users">
                            <tr class="table-header-nb">
                                <th>&nbsp;</th>
                                <th class="text-center">{{ __('Access')}} <small><a href="javascript:void(0)" class="sel-all" data-target="access">{{ __('all') }}</a> / <a href="javascript:void(0)" class="sel-none" data-target="access">{{ __('none') }}</a></small></th>
                                <th class="text-center">{{ __('Manager')}} <small><a href="javascript:void(0)" class="sel-all" data-target="manage">{{ __('all') }}</a> / <a href="javascript:void(0)" class="sel-none" data-target="manage">{{ __('none') }}</a></small></th>
                            </tr>
                            @foreach ($mailboxes as $mailbox)
                                <tr>
                                    <td>{{ $mailbox->name }}</td>
                                    <td class="text-center">
                                        <input class="access" type="checkbox" name="mailboxes[]" id="access-{{ $mailbox->id }}" value="{{ $mailbox->id }}" data-id="{{ $mailbox->id }}" @if ($user_mailboxes->contains($mailbox)) checked="checked" @endif>
                                    </td>
                                    <td class="text-center">
                                        <input class="manage" type="checkbox" name="manage[]" id="manage-{{ $mailbox->id }}" data-id="{{ $mailbox->id }}" value="{{ $mailbox->id }}" @if (in_array($mailbox->id, $manages)) checked="checked" @endif>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="form-group margin-top">

                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Permissions') }}
                            </button>

                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    permissionsInit();
@endsection
