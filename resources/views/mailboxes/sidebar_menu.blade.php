<div class="dropdown sidebar-title">
    @php
        $menu_mailboxes = auth()->user()->mailboxesCanView();
    @endphp
    <span class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        {{ $mailbox->name }} @if (count($menu_mailboxes) && Auth::user()->isAdmin())<span class="caret"></span>@endif
    </span>
    @if (count($menu_mailboxes) && Auth::user()->isAdmin())
        <ul class="dropdown-menu">
            @foreach ($menu_mailboxes as $mailbox_item)
                <li @if ($mailbox_item->id == $mailbox->id)class="active"@endif><a href="{{ route(Eventy::filter('mailboxes.menu_current_route', Route::currentRouteName()), ['id'=>$mailbox_item->id]) }}">{{ $mailbox_item->name }}</a></li>
            @endforeach
        </ul>
    @endif
    <span class="sidebar-title-email">{{ $mailbox->email }}</span>
</div>
<ul class="sidebar-menu">
    @include("mailboxes/settings_menu")
</ul>
<a href="{{ route('mailboxes.view', ['id' => $mailbox->id]) }}" class="btn btn-bordered btn-sidebar btn-rounded" data-toggle="tooltip" title="{{ __("Open Mailbox") }}"><i class="glyphicon glyphicon-arrow-right"></i></a>
