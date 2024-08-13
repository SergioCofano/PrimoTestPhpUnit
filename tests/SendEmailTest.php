<?php
use PHPUnit\Framework\TestCase;
use PrimoTestPhpUnit\EmailSender;

class SendEmailTest extends TestCase
{
    public function testEmailSending()
    {
        // Usa il mock per EmailSender
        $emailSender = $this->createMock(EmailSender::class);

        $emailSender->expects($this->once())
                    ->method('sendEmail')
                    ->with(
                        $this->equalTo('test@example.com'),
                        $this->equalTo('Test Subject'),
                        $this->equalTo('Test Message')
                    )
                    ->willReturn(true);

        // Simula i dati POST
        $_POST['send'] = true;
        $_POST['email'] = 'test@example.com';
        $_POST['subject'] = 'Test Subject';
        $_POST['message'] = 'Test Message';

        // Simula l'ambiente e chiama la funzione di invio email
        $result = $emailSender->sendEmail(
            $_POST['email'],
            $_POST['subject'],
            $_POST['message']
        );

        // Verifica il risultato
        $this->assertTrue($result);
    }
}
?>