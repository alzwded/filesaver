#!/bin/sh

curl -X POST --verbose -H "Content-Type: application/json" --data @test.json http://localhost:1234/saver.php
