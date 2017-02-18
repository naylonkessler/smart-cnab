<?php

include 'fake/TestReturning.php';

// class ReturningTest extends PHPUnit_Framework_TestCase
// {
//     public function testSchemaReading()
//     {
//         $return = new TestReturning(
//             'fake/sample.RET',
//             new \SmartCNAB\Support\Picture()
//         );
//         $lines = $return->begin([])
//                             ->addDetail([
//                                 'occurrenceCode' => 1,
//                                 'field1' => 'FIELD1',
//                                 'field2' => 2,
//                             ])
//                             ->end()
//                             ->getLines();

//         $this->assertTrue(is_array($lines));
//         $this->assertCount(4, $lines);
//         $this->assertCount(3, $lines[0]);
//         $this->assertCount(6, $lines[1]);
//         $this->assertCount(3, $lines[2]);
//         $this->assertEquals(400, strlen(implode('', $lines[0])));
//         $this->assertEquals(400, strlen(implode('', $lines[1])));
//         $this->assertEquals(400, strlen(implode('', $lines[2])));
//         $this->assertEquals('01', $lines[1]['occurrenceCode']);
//         $this->assertEquals('FIELD1    ', $lines[1]['field1']);
//         $this->assertEquals('000002', $lines[1]['field2']);
//     }
// }