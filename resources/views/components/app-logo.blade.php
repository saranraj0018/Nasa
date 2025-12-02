   @props(['url' => '/'])
   <a href="{{ $url }}" class="space-y-1">
       <div class="text-4xl font-bold text-primary">NASA</div>
       <div class="text-lg font-medium">
        @if (!empty(session()->get('super_admin')))
            Super Admin Portal
        @elseif (!empty(session()->get('admin')))
            Admin Portal
        @elseif (!empty(session()->get('student')))
            Student Portal
        @endif
       </div>
   </a>
