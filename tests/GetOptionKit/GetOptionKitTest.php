<?php
/*
 * This file is part of the GetOptionKit package.
 *
 * (c) Yo-An Lin <cornelius.howl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
class GetOptionKitTest extends PHPUnit_Framework_TestCase 
{

    function test()
    {
        $opt = new \GetOptionKit\GetOptionKit;
        ok( $opt );

        $opt->add( 'f|foo:' , 'option require value' );
        $opt->add( 'b|bar+' , 'option require multiple value' );
        $opt->add( 'z|zoo?' , 'option with optional value' );
        $opt->add( 'v|verbose' , 'verbose message' );
        $opt->add( 'd|debug'   , 'debug message' );

        $spec = $opt->get('foo');
        ok( $spec->isAttributeRequire() );

        $spec = $opt->get('bar');
        ok( $spec->isAttributeMultiple() );

        $spec = $opt->get('zoo');
        ok( $spec->isAttributeOptional() );

        $spec = $opt->get( 'debug' );
        ok( $spec );
        is_class( 'GetOptionKit\\OptionSpec', $spec );
        is( 'debug', $spec->long );
        is( 'd', $spec->short );
        ok( $spec->isAttributeFlag() );

        $result = $opt->parse( array( 'program' , '-f' , 'foo value' , '-v' , '-d' ) );

        ok( $result );
        ok( $result->foo );
        ok( $result->verbose );
        ok( $result->debug );

        $foo = $result->foo;

    }


}
