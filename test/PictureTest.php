<?php

class PictureTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $picture = new \SmartCNAB\Support\Picture();
        $string = $picture->parse('X(08)');
        $number = $picture->parse('9(06)');
        $date = $picture->parse('9(06)', ['type' => 'date']);
        $money = $picture->parse('9(08)V9(02)');

        $this->assertEquals([
            'data-type' => 'string',
            'info-type' => 'generic',
            'size' => 8,
        ], $string);
        $this->assertEquals([
            'data-type' => 'numeric',
            'info-type' => 'generic',
            'size' => 6,
        ], $number);
        $this->assertEquals([
            'data-type' => 'numeric',
            'info-type' => 'date',
            'size' => 6,
            'type' => 'date',
        ], $date);
        $this->assertEquals([
            'data-type' => 'numeric',
            'info-type' => 'money',
            'size' => 10,
            'first' => 8,
            'last' => 2,
        ], $money);
    }

    public function testPictureToFormat()
    {
        $picture = new \SmartCNAB\Support\Picture();
        $string = $picture->to('X(06)', 'NKA');
        $number = $picture->to('9(04)', '11');
        $money = $picture->to('9(04)V9(2)', 123.12000);
        $date = $picture->to('9(06)', new \DateTime('2016-06-09'), ['type' => 'date']);

        $this->assertEquals('NKA   ', $string);
        $this->assertEquals('0011', $number);
        $this->assertEquals('012312', $money);
        $this->assertEquals('090616', $date);
    }

    public function testPictureFromFormat()
    {
        $picture = new \SmartCNAB\Support\Picture();
        $string = $picture->from('X(06)', 'NKA   ');
        $number = $picture->from('9(04)', '0011');
        $money = $picture->from('9(04)V9(2)', '012312');
        $date = $picture->from('9(06)', '090616', ['type' => 'date']);

        $refDate = new \DateTime('2016-06-09');

        $this->assertEquals('NKA', $string);
        $this->assertEquals(11, $number);
        $this->assertEquals(123.12, $money);
        $this->assertEquals($refDate->format('dmy'), $date->format('dmy'));
    }

    public function testPictureToDefault()
    {
        $picture = new \SmartCNAB\Support\Picture();
        $number = $picture->to('9(04)', '', ['def' => '12']);
        $date = $picture->to('9(06)', '', ['type' => 'date', 'def' => '@auto']);

        $refDate = new \DateTime();

        $this->assertEquals('0012', $number);
        $this->assertEquals($refDate->format('dmy'), $date);
    }
}