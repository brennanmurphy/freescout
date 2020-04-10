@extends('layouts.app')

@section('title_full', __('Mailbox Permissions').' - '.$mailbox->name)

@section('sidebar')
    @include('partials/sidebar_menu_toggle')
    @include('mailboxes/sidebar_menu')
@endsection

@section('content')
    <div class="section-heading">
        {{ __('Permissions') }}
    </div>

    @include('partials/flash_messages')

    <div class="container form-container">
        <div class="row">
            <form method="POST" action="">
                <div class="col-xs-12">
                    <h3> {{ __('Selected Users have access to this mailbox:') }}</h3>
                    <p class="block-help">{{ __('Administrators have access to all mailboxes and are not listed here.') }}</p>
                </div>
                <div class="col-md-11 col-lg-9">

                    {{ csrf_field() }}

                    <table class="table" id="permissions-users">
                        <tr class="table-header-nb">
                            <th>&nbsp;</th>
                            <th class="text-center">{{ __('Access')}} <small><a href="javascript:void(0)" class="sel-all" data-target="access">{{ __('all') }}</a> / <a href="javascript:void(0)" class="sel-none" data-target="access">{{ __('none') }}</a></small></th>
                            @if (Auth::user()->isAdmin())
                                <th class="text-center">{{ __('Manager')}} <small><a href="javascript:void(0)" class="sel-all" data-target="manage">{{ __('all') }}</a> / <a href="javascript:void(0)" class="sel-none" data-target="manage">{{ __('none') }}</a></small></th>
                            @endif
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->getFullName() }}</td>
                                <td class="text-center">
                                    <input class="access" type="checkbox" name="users[]" id="access-{{ $user->id }}" value="{{ $user->id }}" data-id="{{ $user->id }}" @if (!empty($user->mailbox_user_id)) checked="checked" @endif>
                                </td>
                                @if (Auth::user()->isAdmin())
                                    <td class="text-center">
                                        <input class="manage" type="checkbox" name="manage[]" id="manage-{{ $user->id }}" data-id="{{ $user->id }}" @if (!empty($user->manage)) checked="checked" @endif value="{{ $user->id }}">
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>

                </div>

                <div class="col-xs-12 margin-top">
                    <h3> {{ __('Administrators') }}:</h3>
                </div>
                <div class="col-md-11 col-lg-9">

                    <table class="table">
                        <tr class="table-header-nb">
                            <th>&nbsp;</th>
                            <th class="text-center">{{ __('Hide from Assign list') }} <small><a href="javascript:void(0)" class="sel-all" data-target="admin-hide">{{ __('all') }}</a> / <a href="javascript:void(0)" class="sel-none" data-target="admin-hide">{{ __('none') }}</a></small></th>
                        </tr>
                        <fieldset id="permissions-admin-fields">
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->getFullName() }}</td>
                                    <td class="text-center"><input class="admin-hide" type="checkbox" name="admins[{{ $admin->id }}][hide]" value="1" @if (!empty($admin->hide)) checked="checked" @endif></td>
                                </tr>
                            @endforeach
                        </fieldset>
                    </table>
                    <div class="form-group margin-top">

                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    permissionsInit();
@endsection
