<h2>Restore Password in User Company Api</h2>

<p>We have received a request to reset your password. Please follow the link below to complete this process.</p>
<span>
    <a href="{{route('recover_password', ['recover_token' => $data['recover_token']])}}">Recover your password</a>
</span>


