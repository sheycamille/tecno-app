 <!-- Widgets -->
 <div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people</i>
            </div>
            <div class="content">
                <div class="text">Total Users</div>
                <div class="number count-to" data-from="0" data-to="{{\DB::table('users')->count();}}" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">assignment_ind</i>
            </div>
            <div class="content">
                <div class="text">Total Roles</div>
                <div class="number count-to" data-from="0" data-to="{{\DB::table('roles')->count();}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">lock_open</i>
            </div>
            <div class="content">
                <div class="text">Total Permissions</div>
                <div class="number count-to" data-from="0" data-to="{{\DB::table('permissions')->count();}}" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    
</div>
<!-- #END# Widgets -->