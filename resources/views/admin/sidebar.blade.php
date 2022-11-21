<nav class="sidebar sidebar-offcanvas remove2" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top remove2">
      <a class="sidebar-brand brand-logo remove2" href="{{ url('/home') }}"><h1 style="color: white">S_BANKING PRO</h1></a>
      <a class="sidebar-brand brand-logo-mini remove2" href="{{ url('/home') }}"><h1 style="color: white">SB PRO</h1></a>
    </div>
    <ul class="nav remove2">
      <li class="nav-item profile">
        <div class="profile-desc remove2">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="admin/assets/images/faces/face15.jpg" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
              <span>Gold Member</span>
            </div>
          </div>
          <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-onepassword  text-info"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-calendar-today text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
              </div>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('/home') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      {{-- <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('addloan') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Add Loan</span>
        </a>
      </li> --}}

      {{-- <li class="nav-item menu-items">
        <a class="nav-link" href="{{ url('airtime_view') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Buy Airtime</span>
        </a>
      </li> --}}

        {{-- posting management --}}

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#authposting" aria-expanded="false" aria-controls="authposting">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Posting Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="authposting">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('customer-deposit') }}">Customer Deposit</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('customer-wdr') }}">Customer Withdrawal</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('Bank-Deposit') }}">Bank Deposit</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('Bank-wdr') }}">Bank Withdrawal</a></li>

            <li class="nav-item"> <a class="nav-link" href="{{ url('Special-Deduction') }}">Special Deduction</a></li>

          
          </ul>
        </div>
      </li>
        {{-- end of posting management --}}
    
  {{-- user management --}}
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth2">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth2">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('createuser') }}">Add User </a></li>

            <li class="nav-item"> <a class="nav-link" href="{{ url('accesstype') }}">Add Access Type to User </a></li>
          </ul>
        </div>
      </li>
        {{--end of user management --}}

        {{-- Teller management --}}
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth2-1" aria-expanded="false" aria-controls="auth2-1">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Teller Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth2-1">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('addteller') }}">Add Tellers Till</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('TellerTransaction') }}">Teller Transaction </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('TillBalance') }}">Tellers Till Bal </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('dailytill') }}">Daily Till Transaction </a></li>
          </ul>
        </div>
      </li>
        {{--end of Teller management --}}

        {{-- account management --}}

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth3" aria-expanded="false" aria-controls="auth3">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Account Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth3">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('add_account_type') }}">Add Account Type </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('add_account_officer') }}"> Create Account Officer </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('create_account') }}"> Create Customer Account </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('Edit-Customer-details') }}">Edit Customer Details </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('account-update') }}">Update Sign/passport </a></li>
          </ul>
        </div>
      </li>
  {{--end Account  management --}}

  {{-- GL management --}}
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth4" aria-expanded="false" aria-controls="auth4">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">GL Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth4">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('sub-class') }}">Create GL Sub-Class</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('create-GL') }}">Create GL</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('GL-to-GL') }}">GL to GL Transaction</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('GL-to-Account') }}">GL to Account Transaction</a></li>
          </ul>
        </div>

        
      </li>
        {{-- end of GL management --}}

  {{-- investment management --}}

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth5" aria-expanded="false" aria-controls="auth5">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Investment Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth5">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('Investment-booking') }}">Investment Booking</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('cert_generate') }}">Certificate</a></li>
          </ul>
        </div>

        
      </li>
        {{-- end of  investment management --}}


      {{-- loan management --}}



      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#authloan" aria-expanded="false" aria-controls="authloan">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Loan Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="authloan">
          <ul class="nav flex-column sub-menu">
           
            <li class="nav-item"> <a class="nav-link" href="#" data-toggle="modal" data-target="#loanmodal1">Add Loan Type</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('Flat-Rate-LoanBooking') }}">Flat-Rate-Loan</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('ReducingBalance-LoanBooking') }}">Reducing-balance-Loan</a></li>
          </ul>
        </div>

       
      </li>


      {{-- end loan management --}}

       {{-- TRansfer management --}}



       <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#authintratransfer" aria-expanded="false" aria-controls="authintratransfer">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Intra Bank Transfer</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="authintratransfer">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('Intra-Transfer') }}">Transfer</a></li>
          </ul>
        </div>

       
      </li>


      {{-- end transfer management --}}


      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth6" aria-expanded="false" aria-controls="auth6">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Admin Portal</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth6">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('Organization-Reg') }}">Register Org</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('deactivate_Users') }}">Deactivate All Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('activate_users') }}">activate All Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('createaccesstype') }}">Access Type SetUp </a></li>
          </ul>
        </div>

        
      </li>
    
    
      
    
    
    </ul>
  </nav>
  

                       <!-- Modal -->
<div class="modal fade" id="loanmodal1" tabindex="-1" role="dialog" aria-labelledby="loanmodal2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loanmodal2">Add Loan Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="loanform" method="POST" autocomplete="off" >
          @csrf
          <div class="form-group">
            <input type="text" name="loantype" id="loantype" placeholder="Enter New loan type" class="form-control">

          </div>
      </div>
      <div class="modal-footer">
        <small id="infoloan"></small>

        
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary button button1" id="saveloantype">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>
        