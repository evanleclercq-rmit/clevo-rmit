@extends('layouts.app')

@section('content')

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Getting Started</b></h3>
				<br>
				<h4><i>Updated November, 2016</i></h4>
				
				<h3>Register</h3>
				<ul>
				<li>1. Click on the register button</li>
				<li>2. Fill out the Name field</li>
				<li>3. Fill out the Email Address field</li>
				<li>4. Fill out the City field</li>
				<li>5. Fill out the Age field (must be 18 or over to be allowed to create an account)</li>
				<li>6. Choose a password and input it into the Password field</li>
				<li>7. Confirm password chosen by typing it again into the Confirm Password field</li>
				<li>8. Register the account by pressing the Register button</li>
				<ol>a. If successful, you will be redirected to the Dashboard page</ol>
				<ol>b. If validation fails, you will be notified on the form requirements such as: minimum age must be 18, password must be at least 8 characters long and must contain at least a letter, a number and special character.</ol>
				</ul>
			
				<h3>Login/Logout</h3>
				<ul>
				<li>1. Fill out the Email Address field</li>
				<li>2. Fill out the Password field</li>
				<li>3. Tick the “Remember Me” radio box for fast access next time you log in</li>
				<li>4. Click on Login and you will be redirected to the Dashboard page</li>
				<li>5. While logged in, throughout the website you have the option to logout by clicking/pressing the Logout button located on top right of the page, which will redirect back to the Login page</li>
				<li>6. If you forgot the password, there is a “Forgot Your Password” option on the Login page to assist with password reset via link sent by email.</li>
				</ul>
			
				<h3>Buy Shares</h3>
				<ul>
				<li>1. Navigate to the Transactions page</li>
				<li>2. Select the Buy radio button</li>
				<li>3. Select number of the shares to be purchased</li>
				<li>4. Press the ‘Buy Shares’ button</li>
				<li>5. You will be notified of the success of purchase and the amount deducted from your balance</li>
				
				</ul>

				<h3>Sell Shares</h3>
				<ul>
				<li>1. Navigate to the Transactions page</li>
				<li>2. Select the Sell radio button</li>
				<li>3. Select the shares you would like to sell from the drop down menu that contains the current owned shares</li>
				<li>4. Enter the number of shares to sell</li>
				<li>5. Push the ‘Sell Shares’ button</li>
				</ul>
				
				<h3>View live updates of share pricing and fluctuations</h3>
				<ul>
				<li>1. Login</li>
				<li>2. Select a company from the drop down menu under View Live Stock box to view its live share value</li>
				<li>3. Alternatively, selected a company from the Watch List drop down menu on the same page but from the Watch List box, to view its live share pricing </li>
				<li>4. Alternatively, navigate to the Transactions page, select the buy or sale option and select a company from the drop down menu to view its current share value</li>
				</ul>

				<h3>View transactions history</h3>
				<ul>
				<li>1. Login</li>
				<li>2. Navigate to the Transactions History page. You will be prompted with all transactions ever made. Use From and To calendar to select a specific date range to display the transactions for</li>
				</ul>
				
				<h3>View current balance</h3>
				<ul>
				<li>1. Login</li>
				<li>2. View current holdings section in the middle of the dashboard which includes the cash balance, the shares values and the total holdings value</li>
				<li>3. Alternatively navigate to the profile page - top right of the screen and view  trading details at the bottom section of the page which includes the current cash balance, total share value the average share value and the total holdings value</li>
				</ul>

				<h3>View leaderboard</h3>
				<ul>
				<li>1. Log in</li>
				<li>2. View the leaderboard section on the righthand side of the dashboard. The leaderboard is populated with all registered users total holdings including cash and share value</li>
				</ul>

				<h3>View admin functionality</h3>
				<ul>
				<li>1. Log in as Admin</li>
				<li>2. Navigate to settings page</li>
				<li>3. Select a user from the drop down menu</li>
				<li>4. Grant a user admin privileges</li>
				<li>5. Revoke a user admin privileges</li>
				<li>6. Reset a user account</li>
				<li>7. Delete User Account</li>
				</ul>
				<br>
			
				<p><i>CLEVO Team</i></p>	
			</div>
		</div>
	</div>
</div>

@endsection
