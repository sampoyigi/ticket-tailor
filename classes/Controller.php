<?php

class Controller
{
    public function onSubmit(): void
    {
        if (!strlen($name = $this->post('name')))
            throw new Exception('Please enter your name');

        if (!strlen($telephone = $this->post('telephone')))
            throw new Exception('Please enter your telephone number');

        if (!strlen($workshop = $this->post('workshop')))
            throw new Exception('Please choose a workshop');

        if (!strlen($email = $this->post('email')))
            throw new Exception('Please enter your email address');

        if (!strlen($password = $this->post('password')))
            throw new Exception('Please enter your password');

        $model = Model::make();

        $model->save([
            'name' => $name,
            'telephone' => $telephone,
            'workshop' => $workshop,
            'email' => $email,
            'password' => sha1($password), // TODO: hash password
            'voucher_code' => $voucherCode = $model->generateVoucherCode(),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'registered_at' => date('Y-m-d H:i:s'),
        ]);

        $this->redirect('/?'.http_build_query(['name' => $name, 'code' => $voucherCode]));
    }

    protected function post($key = null, $default = null): mixed
    {
        if (is_null($key))
            return $_POST;

        if (array_key_exists($key, $_POST)) {
            $result = $_POST[$key];
            if (is_string($result)) $result = trim($result);

            return $result;
        }

        return $default;
    }

    protected function redirect($url): void
    {
        header('Location: '.$url);
        exit;
    }
}