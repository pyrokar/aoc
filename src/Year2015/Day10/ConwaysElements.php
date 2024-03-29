<?php

declare(strict_types=1);

namespace AOC\Year2015\Day10;

use AOC\Util\Chemistry\Element;

final class ConwaysElements
{
    /**
     * @var array<string, string>
     */
    public static array $sequence = [
        Element::H => '22',
        Element::He => '13112221133211322112211213322112',
        Element::Li => '312211322212221121123222112',
        Element::Be => '111312211312113221133211322112211213322112',
        Element::B => '1321132122211322212221121123222112',
        Element::C => '3113112211322112211213322112',
        Element::N => '111312212221121123222112',
        Element::O => '132112211213322112',
        Element::F => '31121123222112',
        Element::Ne => '111213322112',
        Element::Na => '123222112',
        Element::Mg => '3113322112',
        Element::Al => '1113222112',
        Element::Si => '1322112',
        Element::P => '311311222112',
        Element::S => '1113122112',
        Element::Cl => '132112',
        Element::Ar => '3112',
        Element::K => '1112',
        Element::Ca => '12',
        Element::Sc => '3113112221133112',
        Element::Ti => '11131221131112',
        Element::V => '13211312',
        Element::Cr => '31132',
        Element::Mn => '111311222112',
        Element::Fe => '13122112',
        Element::Co => '32112',
        Element::Ni => '11133112',
        Element::Cu => '131112',
        Element::Zn => '312',
        Element::Ga => '13221133122211332',
        Element::Ge => '31131122211311122113222',
        Element::As => '11131221131211322113322112',
        Element::Se => '13211321222113222112',
        Element::Br => '3113112211322112',
        Element::Kr => '11131221222112',
        Element::Rb => '1321122112',
        Element::Sr => '3112112',
        Element::Y => '1112133',
        Element::Zr => '12322211331222113112211',
        Element::Nb => '1113122113322113111221131221',
        Element::Mo => '13211322211312113211',
        Element::Tc => '311322113212221',
        Element::Ru => '132211331222113112211',
        Element::Rh => '311311222113111221131221',
        Element::Pd => '111312211312113211',
        Element::Ag => '132113212221',
        Element::Cd => '3113112211',
        Element::In => '11131221',
        Element::Sn => '13211',
        Element::Sb => '3112221',
        Element::Te => '1322113312211',
        Element::I => '311311222113111221',
        Element::Xe => '11131221131211',
        Element::Cs => '13211321',
        Element::Ba => '311311',
        Element::La => '11131',
        Element::Ce => '1321133112',
        Element::Pr => '31131112',
        Element::Nd => '111312',
        Element::Pm => '132',
        Element::Sm => '311332',
        Element::Eu => '1113222',
        Element::Gd => '13221133112',
        Element::Tb => '3113112221131112',
        Element::Dy => '111312211312',
        Element::Ho => '1321132',
        Element::Er => '311311222',
        Element::Tm => '11131221133112',
        Element::Yb => '1321131112',
        Element::Lu => '311312',
        Element::Hf => '11132',
        Element::Ta => '13112221133211322112211213322113',
        Element::W => '312211322212221121123222113',
        Element::Re => '111312211312113221133211322112211213322113',
        Element::Os => '1321132122211322212221121123222113',
        Element::Ir => '3113112211322112211213322113',
        Element::Pt => '111312212221121123222113',
        Element::Au => '132112211213322113',
        Element::Hg => '31121123222113',
        Element::Tl => '111213322113',
        Element::Pb => '123222113',
        Element::Bi => '3113322113',
        Element::Po => '1113222113',
        Element::At => '1322113',
        Element::Rn => '311311222113',
        Element::Fr => '1113122113',
        Element::Ra => '132113',
        Element::Ac => '3113',
        Element::Th => '1113',
        Element::Pa => '13',
        Element::U => '3',
    ];

    /**
     * @var array<string, array<string>>
     */
    public static array $decaysInto = [
        Element::H => [Element::H],
        Element::He => [Element::Hf, Element::Pa, Element::H, Element::Ca, Element::Li],
        Element::Li => [Element::He],
        Element::Be => [Element::Ge, Element::Ca, Element::Li],
        Element::B => [Element::Be],
        Element::C => [Element::B],
        Element::N => [Element::C],
        Element::O => [Element::N],
        Element::F => [Element::O],
        Element::Ne => [Element::F],
        Element::Na => [Element::Ne],
        Element::Mg => [Element::Pm, Element::Na],
        Element::Al => [Element::Mg],
        Element::Si => [Element::Al],
        Element::P => [Element::Ho, Element::Si],
        Element::S => [Element::P],
        Element::Cl => [Element::S],
        Element::Ar => [Element::Cl],
        Element::K => [Element::Ar],
        Element::Ca => [Element::K],
        Element::Sc => [Element::Ho, Element::Pa, Element::H, Element::Ca, Element::Co],
        Element::Ti => [Element::Sc],
        Element::V => [Element::Ti],
        Element::Cr => [Element::V],
        Element::Mn => [Element::Cr, Element::Si],
        Element::Fe => [Element::Mn],
        Element::Co => [Element::Fe],
        Element::Ni => [Element::Zn, Element::Co],
        Element::Cu => [Element::Ni],
        Element::Zn => [Element::Cu],
        Element::Ga => [Element::Eu, Element::Ca, Element::Ac, Element::H, Element::Ca, Element::Zn],
        Element::Ge => [Element::Ho, Element::Ga],
        Element::As => [Element::Ge, Element::Na],
        Element::Se => [Element::As],
        Element::Br => [Element::Se],
        Element::Kr => [Element::Br],
        Element::Rb => [Element::Kr],
        Element::Sr => [Element::Rb],
        Element::Y => [Element::Sr, Element::U],
        Element::Zr => [Element::Y, Element::H, Element::Ca, Element::Tc],
        Element::Nb => [Element::Er, Element::Zr],
        Element::Mo => [Element::Nb],
        Element::Tc => [Element::Mo],
        Element::Ru => [Element::Eu, Element::Ca, Element::Tc],
        Element::Rh => [Element::Ho, Element::Ru],
        Element::Pd => [Element::Rh],
        Element::Ag => [Element::Pd],
        Element::Cd => [Element::Ag],
        Element::In => [Element::Cd],
        Element::Sn => [Element::In],
        Element::Sb => [Element::Pm, Element::Sn],
        Element::Te => [Element::Eu, Element::Ca, Element::Sb],
        Element::I => [Element::Ho, Element::Te],
        Element::Xe => [Element::I],
        Element::Cs => [Element::Xe],
        Element::Ba => [Element::Cs],
        Element::La => [Element::Ba],
        Element::Ce => [Element::La, Element::H, Element::Ca, Element::Co],
        Element::Pr => [Element::Ce],
        Element::Nd => [Element::Pr],
        Element::Pm => [Element::Nd],
        Element::Sm => [Element::Pm, Element::Ca, Element::Zn],
        Element::Eu => [Element::Sm],
        Element::Gd => [Element::Eu, Element::Ca, Element::Co],
        Element::Tb => [Element::Ho, Element::Gd],
        Element::Dy => [Element::Tb],
        Element::Ho => [Element::Dy],
        Element::Er => [Element::Ho, Element::Pm],
        Element::Tm => [Element::Er, Element::Ca, Element::Co],
        Element::Yb => [Element::Tm],
        Element::Lu => [Element::Yb],
        Element::Hf => [Element::Lu],
        Element::Ta => [Element::Hf, Element::Pa, Element::H, Element::Ca, Element::W],
        Element::W => [Element::Ta],
        Element::Re => [Element::Ge, Element::Ca, Element::W],
        Element::Os => [Element::Re],
        Element::Ir => [Element::Os],
        Element::Pt => [Element::Ir],
        Element::Au => [Element::Pt],
        Element::Hg => [Element::Au],
        Element::Tl => [Element::Hg],
        Element::Pb => [Element::Tl],
        Element::Bi => [Element::Pm, Element::Pb],
        Element::Po => [Element::Bi],
        Element::At => [Element::Po],
        Element::Rn => [Element::Ho, Element::At],
        Element::Fr => [Element::Rn],
        Element::Ra => [Element::Fr],
        Element::Ac => [Element::Ra],
        Element::Th => [Element::Ac],
        Element::Pa => [Element::Th],
        Element::U => [Element::Pa],
    ];
}
