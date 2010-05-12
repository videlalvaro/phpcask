#!/bin/sh
cd `dirname $0`

erl -pa $PWD/ebin -sname phpcask -s phpcask_control