@if($org_user['u_org_role_id'] == 1){
    @component('admin.ad-dashboard',[ 'org_slug' => $org_slug ]);
    @endcomponent
}
@elseif($org_user['u_org_role_id'] == 2){
    
    @component('manager.managerdashboard',[ 'org_slug' => $org_slug ]);
    @endcomponent
}
@else{
    @component('user.userdashboard',[ 'org_slug' => $org_slug ]);
    @endcomponent
}
@endif

