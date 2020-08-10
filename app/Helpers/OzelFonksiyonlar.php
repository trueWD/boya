<?php

function tutarToRaw($string)
{
    // Formdan gelen değerleri arasal olarak ayarlar MySQL İçin
    // Birinci dizideki değerleri ikinci dizideki alanlarla deiştiriyor
    return str_replace(['.', ','], ['', '.'], trim($string));

}
function ondalikDegistir($string)
{
    // Bu para ondalığını değiştiriyor
    return str_replace(['.'], [','], trim($string));

}
function para($string)
{
    // Türkçe Number Format
    return number_format($string,2,',', '.');

}
function paraEn($string)
{
    // İnglizce saf paraya çevirir 
    // Veri banaına kayıt için
    return number_format($string, 2, '.', '');
}



function aramaTextTemizle($string)
{
    // Formdan gelen değerleri arasal olarak ayarlar MySQL İçin
    // Birinci dizideki değerleri ikinci dizideki alanlarla deiştiriyor
    return str_replace([' ', '  '], ['%', '%'], trim($string));

}

function tarih($string)
{

    $newDate = date("d.m.Y", strtotime($string));
    return $newDate;

}
function tarihSaat($string)
{

    $newDate = date("d.m.Y H:i:s", strtotime($string));
    return $newDate;

}
