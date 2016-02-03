<?php declare(strict_types = 1);

/**
 * @covers User
 */
class UserTest extends PHPUnit_Framework_TestCase
{
    use UserHelperTrait;

    public function testUsersWithSameEmailAreEqual()
    {
        $user1 = new User($this->mockNickname(), $this->mockEmail('some@email.com'));
        $user2 = new User($this->mockNickname(), $this->mockEmail('some@email.com'));
        $this->assertTrue($user1->equals($user2));
    }

    public function testUsersWithDifferentEmailsAreNotEqual()
    {
        $nickname1 = $this->mockNickname();
        $nickname1->method('__toString')->willReturn('bla');
        $nickname2 = $this->mockNickname();
        $nickname2->method('__toString')->willReturn('bla');

        $user1 = new User($nickname1, $this->mockEmail('one@email.com'));
        $user2 = new User($nickname2, $this->mockEmail('other@email.com'));
        $this->assertFalse($user1->equals($user2));
    }

    public function testUsersWithSameEmailButDifferentNicknamesAreNotEqual()
    {
        $nickname1 = $this->mockNickname();
        $nickname1->method('__toString')->willReturn('blub');
        $nickname2 = $this->mockNickname();
        $nickname2->method('__toString')->willReturn('bla');
        $user1 = new User($nickname1, $this->mockEmail('one@email.com'));
        $user2 = new User($nickname2, $this->mockEmail('one@email.com'));
        $this->assertFalse($user1->equals($user2));
    }

    public function testHasNickname()
    {
        $nickname = new Nickname('blaaa');
        $user = new User($nickname, new Email('bla@bla.com'));
        $this->assertEquals($nickname, $user->nickname());
    }

    public function testHasEmail()
    {
        $email = new Email('bla@bla.com');
        $user = new User(new Nickname('blaaa'), $email);
        $this->assertEquals($email, $user->email());
    }
}
