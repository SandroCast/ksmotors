<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $codigo = rand(1000, 9999);
        $email = $input['email'];
        
        $this->emailVerifica($codigo, $email);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'cod_verificacao' => $codigo,
        ]);
        
    }

    public function emailVerifica($codigo, $email)
    {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        try {

            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            //$mail->isMail();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'castrosandro2@gmail.com';                 // SMTP username
            $mail->Password = 'ohelcnugpanbdeqh';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('castrosandro2@gmail.com', '3DPrintEvolution');

            $mail->addAddress($email);               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            // $mail->addBCC('fabio@oncore.com.br');
            // $mail->AddAttachment($nome_excel);
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verificação de Email';
            $mail->Body    = '<p>Olá,</p>

            <p>Seu código de verificação é:</p>
            <br>
            <h1 style="color: green; font-weight: bold; text-align: center; font-size: 50px;">'.$codigo.'</h1>';

            //web$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();


        } catch (Exception $e) {


            echo '<br>Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }   


    }



}
