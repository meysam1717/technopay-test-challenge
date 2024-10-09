<?php

namespace Tests\Feature\Notifications;

use App\Notifications\OrderFilterErrorNotification;
use Services\SMS\SingleSMSDTO;
use Tests\TestCase;

class OrderFilterErrorNotificationTest extends TestCase
{

    /** @test */
    public function it_can_determine_the_notification_channels()
    {
        $notifiable = (object)['phone' => '1234567890', 'name' => 'John Doe'];
        $notification = new OrderFilterErrorNotification('This is a test error message.');

        $channels = $notification->via($notifiable);

        $this->assertEquals(['sms-fake', 'mail-fake'], $channels);
    }

    /** @test */
    public function it_can_prepare_the_sms_data()
    {
        $notifiable = (object)['phone' => '1234567890'];
        $notification = new OrderFilterErrorNotification('This is a test error message.');

        $smsDto = $notification->toSingleSMS($notifiable);

        $this->assertInstanceOf(SingleSMSDTO::class, $smsDto);
        $this->assertEquals('1234567890', $smsDto->getPhone());
        $this->assertEquals('This is a test error message.', $smsDto->getMessage());
    }

    /** @test */
    public function it_can_prepare_the_mail_message()
    {
        $notifiable = (object)['name' => 'John Doe'];
        $notification = new OrderFilterErrorNotification('This is a test error message.');

        $mailMessage = $notification->toMail($notifiable);

        $this->assertEquals('Order Filter Error', $mailMessage->subject);
        $this->assertStringContainsString('Hello John Doe', $mailMessage->greeting);
        $this->assertStringContainsString('This is a test error message.', $mailMessage->introLines[0]);
    }

}
