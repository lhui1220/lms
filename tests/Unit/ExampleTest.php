<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testPerf()
    {
        $boxes = collect();

        for ($i = 0; $i < 1000; $i++) {
            $boxes->push(['box_id' => $i, 'box_no' => 'B' . $i]);
        }
        $this->generate($boxes);
    }

    protected function generate(Collection $boxes)
    {
        while (true) {
            $remainingBoxes = $this->create($boxes);

            if ($remainingBoxes->isEmpty()) {
                return ;
            }
            $boxes = $remainingBoxes;
        }
    }

    protected function create(Collection $boxes)
    {
        $remainingBoxes = collect();
        while (true) {
            $count = $boxes->count();
            sleep(random_int(1,3));
            if (!$count) {
                return $remainingBoxes;
            }

            if ($count > 1) {
                $remainingBoxes->push($boxes->pop());
                continue;
            }
            break;
        }
        return $remainingBoxes;
    }
}
