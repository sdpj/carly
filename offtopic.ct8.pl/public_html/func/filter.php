<?php
session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
        
	
function filter($string) {
    $words = array (
  0 => '5h1t ',
  1 => '5hit ',
  2 => 'a55 ',
  3 => 'anal ',
  4 => 'anus ',
  5 => 'ar5e ',
  6 => 'arrse ',
  7 => 'arse ',
  8 => 'ass ',
  9 => 'ass-fucker ',
  10 => 'asses ',
  11 => 'assfucker ',
  12 => 'assfukka ',
  13 => 'asshole ',
  14 => 'assholes ',
  15 => 'asswhole ',
  16 => 'a_s_s ',
  17 => 'b!tch ',
  18 => 'b00bs ',
  19 => 'b17ch ',
  20 => 'b1tch ',
  21 => 'ballbag ',
  22 => 'balls ',
  23 => 'ballsack ',
  24 => 'bastard ',
  25 => 'beastial ',
  26 => 'beastiality ',
  27 => 'bellend ',
  28 => 'bestial ',
  29 => 'bestiality ',
  30 => 'bi+ch ',
  31 => 'biatch ',
  32 => 'bitch ',
  33 => 'bitcher ',
  34 => 'bitchers ',
  35 => 'bitches ',
  36 => 'bitchin ',
  37 => 'bitching ',
  38 => 'bloody ',
  39 => 'blow job ',
  40 => 'blowjob ',
  41 => 'blowjobs ',
  42 => 'boiolas ',
  43 => 'bollock ',
  44 => 'bollok ',
  45 => 'boner ',
  46 => 'boob ',
  47 => 'boobs ',
  48 => 'booobs ',
  49 => 'boooobs ',
  50 => 'booooobs ',
  51 => 'booooooobs ',
  52 => 'breasts ',
  53 => 'buceta ',
  54 => 'bugger ',
  55 => 'bum ',
  56 => 'bunny fucker ',
  57 => 'butt ',
  58 => 'butthole ',
  59 => 'buttmuch ',
  60 => 'buttplug ',
  61 => 'c0ck ',
  62 => 'c0cksucker ',
  63 => 'carpet muncher ',
  64 => 'cawk ',
  65 => 'chink ',
  66 => 'cipa ',
  67 => 'cl1t ',
  68 => 'clit ',
  69 => 'clitoris ',
  70 => 'clits ',
  71 => 'cnut ',
  72 => 'cock ',
  73 => 'cock-sucker ',
  74 => 'cockface ',
  75 => 'cockhead ',
  76 => 'cockmunch ',
  77 => 'cockmuncher ',
  78 => 'cocks ',
  79 => 'cocksuck ',
  80 => 'cocksucked ',
  81 => 'cocksucker ',
  82 => 'cocksucking ',
  83 => 'cocksucks ',
  84 => 'cocksuka ',
  85 => 'cocksukka ',
  86 => 'cok ',
  87 => 'cokmuncher ',
  88 => 'coksucka ',
  89 => 'coon ',
  90 => 'cox ',
  91 => 'crap ',
  92 => 'cum ',
  93 => 'cummer ',
  94 => 'cumming ',
  95 => 'cums ',
  96 => 'cumshot ',
  97 => 'cunilingus ',
  98 => 'cunillingus ',
  99 => 'cunnilingus ',
  100 => 'cunt ',
  101 => 'cuntlick ',
  102 => 'cuntlicker ',
  103 => 'cuntlicking ',
  104 => 'cunts ',
  105 => 'cyalis ',
  106 => 'cyberfuc ',
  107 => 'cyberfuck ',
  108 => 'cyberfucked ',
  109 => 'cyberfucker ',
  110 => 'cyberfuckers ',
  111 => 'cyberfucking ',
  112 => 'd1ck ',
  113 => 'damn ',
  114 => 'dick ',
  115 => 'dickhead ',
  116 => 'dildo ',
  117 => 'dildos ',
  118 => 'dink ',
  119 => 'dinks ',
  120 => 'dirsa ',
  121 => 'dlck ',
  122 => 'dog-fucker ',
  123 => 'doggin ',
  124 => 'dogging ',
  125 => 'donkeyribber ',
  126 => 'doosh ',
  127 => 'duche ',
  128 => 'dyke ',
  129 => 'ejaculate ',
  130 => 'ejaculated ',
  131 => 'ejaculates ',
  132 => 'ejaculating ',
  133 => 'ejaculatings ',
  134 => 'ejaculation ',
  135 => 'ejakulate ',
  136 => 'f u c k ',
  137 => 'f u c k e r ',
  138 => 'f4nny ',
  139 => 'fag ',
  140 => 'fagging ',
  141 => 'faggitt ',
  142 => 'faggot ',
  143 => 'faggs ',
  144 => 'fagot ',
  145 => 'fagots ',
  146 => 'fags ',
  147 => 'fanny ',
  148 => 'fannyflaps ',
  149 => 'fannyfucker ',
  150 => 'fanyy ',
  151 => 'fatass ',
  152 => 'fcuk ',
  153 => 'fcuker ',
  154 => 'fcuking ',
  155 => 'feck ',
  156 => 'fecker ',
  157 => 'felching ',
  158 => 'fellate ',
  159 => 'fellatio ',
  160 => 'fingerfuck ',
  161 => 'fingerfucked ',
  162 => 'fingerfucker ',
  163 => 'fingerfuckers ',
  164 => 'fingerfucking ',
  165 => 'fingerfucks ',
  166 => 'fistfuck ',
  167 => 'fistfucked ',
  168 => 'fistfucker ',
  169 => 'fistfuckers ',
  170 => 'fistfucking ',
  171 => 'fistfuckings ',
  172 => 'fistfucks ',
  173 => 'flange ',
  174 => 'fook ',
  175 => 'fooker ',
  176 => 'fuck ',
  177 => 'fucka ',
  178 => 'fucked ',
  179 => 'fucker ',
  180 => 'fuckers ',
  181 => 'fuckhead ',
  182 => 'fuckheads ',
  183 => 'fuckin ',
  184 => 'fucking ',
  185 => 'fuckings ',
  186 => 'fuckingshitmotherfucker ',
  187 => 'fuckme ',
  188 => 'fucks ',
  189 => 'fuckwhit ',
  190 => 'fuckwit ',
  191 => 'fudge packer ',
  192 => 'fudgepacker ',
  193 => 'fuk ',
  194 => 'fuker ',
  195 => 'fukker ',
  196 => 'fukkin ',
  197 => 'fuks ',
  198 => 'fukwhit ',
  199 => 'fukwit ',
  200 => 'fux ',
  201 => 'fux0r ',
  202 => 'f_u_c_k ',
  203 => 'gangbang ',
  204 => 'gangbanged ',
  205 => 'gangbangs ',
  206 => 'gaylord ',
  207 => 'gaysex ',
  208 => 'goatse ',
  209 => 'god-dam ',
  210 => 'god-damned ',
  211 => 'goddamn ',
  212 => 'goddamned ',
  213 => 'hardcoresex ',
  214 => 'hell ',
  215 => 'heshe ',
  216 => 'hoar ',
  217 => 'hoare ',
  218 => 'hoer ',
  219 => 'homo ',
  220 => 'hore ',
  221 => 'horniest ',
  222 => 'horny ',
  223 => 'hotsex ',
  224 => 'jack-off ',
  225 => 'jackoff ',
  226 => 'jap ',
  227 => 'jerk-off ',
  228 => 'jism ',
  229 => 'jiz ',
  230 => 'jizm ',
  231 => 'jizz ',
  232 => 'kawk ',
  233 => 'knob ',
  234 => 'knobead ',
  235 => 'knobed ',
  236 => 'knobend ',
  237 => 'knobhead ',
  238 => 'knobjocky ',
  239 => 'knobjokey ',
  240 => 'kock ',
  241 => 'kondum ',
  242 => 'kondums ',
  243 => 'kum ',
  244 => 'kummer ',
  245 => 'kumming ',
  246 => 'kums ',
  247 => 'kunilingus ',
  248 => 'l3i+ch ',
  249 => 'l3itch ',
  250 => 'labia ',
  251 => 'lmfao ',
  252 => 'lust ',
  253 => 'lusting ',
  254 => 'm0f0 ',
  255 => 'm0fo ',
  256 => 'm45terbate ',
  257 => 'ma5terb8 ',
  258 => 'ma5terbate ',
  259 => 'masochist ',
  260 => 'master-bate ',
  261 => 'masterb8 ',
  262 => 'masterbat* ',
  263 => 'masterbat3 ',
  264 => 'masterbate ',
  265 => 'masterbation ',
  266 => 'masterbations ',
  267 => 'masturbate ',
  268 => 'mo-fo ',
  269 => 'mof0 ',
  270 => 'mofo ',
  271 => 'mothafuck ',
  272 => 'mothafucka ',
  273 => 'mothafuckas ',
  274 => 'mothafuckaz ',
  275 => 'mothafucked ',
  276 => 'mothafucker ',
  277 => 'mothafuckers ',
  278 => 'mothafuckin ',
  279 => 'mothafucking ',
  280 => 'mothafuckings ',
  281 => 'mothafucks ',
  282 => 'mother fucker ',
  283 => 'motherfuck ',
  284 => 'motherfucked ',
  285 => 'motherfucker ',
  286 => 'motherfuckers ',
  287 => 'motherfuckin ',
  288 => 'motherfucking ',
  289 => 'motherfuckings ',
  290 => 'motherfuckka ',
  291 => 'motherfucks ',
  292 => 'muff ',
  293 => 'mutha ',
  294 => 'muthafecker ',
  295 => 'muthafuckker ',
  296 => 'muther ',
  297 => 'mutherfucker ',
  298 => 'n1gga ',
  299 => 'n1gger ',
  300 => 'nazi ',
  301 => 'nigg3r ',
  302 => 'nigg4h ',
  303 => 'nigga ',
  304 => 'niggah ',
  305 => 'niggas ',
  306 => 'niggaz ',
  307 => 'nigger ',
  308 => 'niggers ',
  309 => 'nob ',
  310 => 'nob jokey ',
  311 => 'nobhead ',
  312 => 'nobjocky ',
  313 => 'nobjokey ',
  314 => 'numbnuts ',
  315 => 'nutsack ',
  316 => 'orgasim ',
  317 => 'orgasims ',
  318 => 'orgasm ',
  319 => 'orgasms ',
  320 => 'p0rn ',
  321 => 'pawn ',
  322 => 'pecker ',
  323 => 'penis ',
  324 => 'penisfucker ',
  325 => 'phonesex ',
  326 => 'phuck ',
  327 => 'phuk ',
  328 => 'phuked ',
  329 => 'phuking ',
  330 => 'phukked ',
  331 => 'phukking ',
  332 => 'phuks ',
  333 => 'phuq ',
  334 => 'pigfucker ',
  335 => 'pimpis ',
  336 => 'piss ',
  337 => 'pissed ',
  338 => 'pisser ',
  339 => 'pissers ',
  340 => 'pisses ',
  341 => 'pissflaps ',
  342 => 'pissin ',
  343 => 'pissing ',
  344 => 'pissoff ',
  345 => 'kkk',
  346 => 'porn ',
  347 => 'porno ',
  348 => 'pornography ',
  349 => 'pornos ',
  350 => 'prick ',
  351 => 'pricks ',
  352 => 'pron ',
  353 => 'pube ',
  354 => 'pusse ',
  355 => 'pussi ',
  356 => 'pussies ',
  357 => 'pussy ',
  358 => 'pussys ',
  359 => 'rectum ',
  360 => 'retard ',
  361 => 'rimjaw ',
  362 => 'rimming ',
  363 => 's hit ',
  364 => 's.o.b. ',
  365 => 'sadist ',
  366 => 'schlong ',
  367 => 'screwing ',
  368 => 'scroat ',
  369 => 'scrote ',
  370 => 'scrotum ',
  371 => 'semen ',
  372 => 'sex ',
  373 => 'sh!+ ',
  374 => 'sh!t ',
  375 => 'sh1t ',
  376 => 'shag ',
  377 => 'shagger ',
  378 => 'shaggin ',
  379 => 'shagging ',
  380 => 'shemale ',
  381 => 'shi+ ',
  382 => 'shit ',
  383 => 'shitdick ',
  384 => 'shite ',
  385 => 'shited ',
  386 => 'shitey ',
  387 => 'shitfuck ',
  388 => 'shitfull ',
  389 => 'shithead ',
  390 => 'shiting ',
  391 => 'shitings ',
  392 => 'shits ',
  393 => 'shitted ',
  394 => 'shitter ',
  395 => 'shitters ',
  396 => 'shitting ',
  397 => 'shittings ',
  398 => 'shitty ',
  399 => 'skank ',
  400 => 'slut ',
  401 => 'sluts ',
  402 => 'smegma ',
  403 => 'smut ',
  404 => 'snatch ',
  405 => 'son-of-a-bitch ',
  406 => 'spac ',
  407 => 'spunk ',
  408 => 's_h_i_t ',
  409 => 't1tt1e5 ',
  410 => 't1tties ',
  411 => 'teets ',
  412 => 'teez ',
  413 => 'testical ',
  414 => 'testicle ',
  415 => 'tit ',
  416 => 'titfuck ',
  417 => 'tits ',
  418 => 'titt ',
  419 => 'tittie5 ',
  420 => 'tittiefucker ',
  421 => 'titties ',
  422 => 'tittyfuck ',
  423 => 'tittywank ',
  424 => 'titwank ',
  425 => 'tosser ',
  426 => 'turd ',
  427 => 'tw4t ',
  428 => 'twat ',
  429 => 'twathead ',
  430 => 'twatty ',
  431 => 'twunt ',
  432 => 'twunter ',
  433 => 'v14gra ',
  434 => 'v1gra ',
  435 => 'vagina ',
  436 => 'viagra ',
  437 => 'vulva ',
  438 => 'w00se ',
  439 => 'wang ',
  440 => 'wank ',
  441 => 'wanker ',
  442 => 'wanky ',
  443 => 'whoar ',
  444 => 'whore ',
  445 => 'willies ',
  446 => 'willy ',
  447 => 'xrated ',
  448 => 'xxx ',
  449 => 'bollocks ',
  450 => 'child-fucker ',
  451 => 'Christ on a bike ',
  452 => 'Christ on a cracker ',
  453 => 'swear word ',
  454 => 'godsdamn ',
  455 => 'holy shit ',
  456 => 'Jesus ',
  457 => 'Jesus Christ ',
  458 => 'Jesus H. Christ ',
  459 => 'Jesus Harold Christ ',
  460 => 'Jesus wept ',
  461 => 'Jesus, Mary and Joseph ',
  462 => 'Judas Priest ',
  463 => 'shit ass ',
  464 => 'shitass ',
  465 => 'son of a bitch ',
  466 => 'son of a motherless goat ',
  467 => 'son of a whore ',
  468 => 'sweet Jesus ',
  469 => '2g1c ',
  470 => '2 girls 1 cup ',
  471 => 'acrotomophilia ',
  472 => 'alabama hot pocket ',
  473 => 'alaskan pipeline ',
  474 => 'anilingus ',
  475 => 'apeshit ',
  476 => 'arsehole ',
  477 => 'assmunch ',
  478 => 'auto erotic ',
  479 => 'autoerotic ',
  480 => 'babeland ',
  481 => 'baby batter ',
  482 => 'baby juice ',
  483 => 'ball gag ',
  484 => 'ball gravy ',
  485 => 'ball kicking ',
  486 => 'ball licking ',
  487 => 'ball sack ',
  488 => 'ball sucking ',
  489 => 'bangbros ',
  490 => 'bareback ',
  491 => 'barely legal ',
  492 => 'barenaked ',
  493 => 'bastardo ',
  494 => 'bastinado ',
  495 => 'bbw ',
  496 => 'bdsm ',
  497 => 'beaner ',
  498 => 'beaners ',
  499 => 'beaver cleaver ',
  500 => 'beaver lips ',
  501 => 'big black ',
  502 => 'big breasts ',
  503 => 'big knockers ',
  504 => 'big tits ',
  505 => 'bimbos ',
  506 => 'birdlock ',
  507 => 'black cock ',
  508 => 'blonde action ',
  509 => 'blonde on blonde action ',
  510 => 'blow your load ',
  511 => 'blue waffle ',
  512 => 'blumpkin ',
  513 => 'bondage ',
  514 => 'booty call ',
  515 => 'brown showers ',
  516 => 'brunette action ',
  517 => 'bukkake ',
  518 => 'bulldyke ',
  519 => 'bullet vibe ',
  520 => 'bullshit ',
  521 => 'bung hole ',
  522 => 'bunghole ',
  523 => 'busty ',
  524 => 'buttcheeks ',
  525 => 'camel toe ',
  526 => 'camgirl ',
  527 => 'camslut ',
  528 => 'camwhore ',
  529 => 'carpetmuncher ',
  530 => 'chocolate rosebuds ',
  531 => 'circlejerk ',
  532 => 'cleveland steamer ',
  533 => 'clover clamps ',
  534 => 'clusterfuck ',
  535 => 'coprolagnia ',
  536 => 'coprophilia ',
  537 => 'cornhole ',
  538 => 'coons ',
  539 => 'creampie ',
  540 => 'darkie ',
  541 => 'date rape ',
  542 => 'daterape ',
  543 => 'deep throat ',
  544 => 'deepthroat ',
  545 => 'dendrophilia ',
  546 => 'dingleberry ',
  547 => 'dingleberries ',
  548 => 'dirty pillows ',
  549 => 'dirty sanchez ',
  550 => 'doggie style ',
  551 => 'doggiestyle ',
  552 => 'doggy style ',
  553 => 'doggystyle ',
  554 => 'dog style ',
  555 => 'dolcett ',
  556 => 'domination ',
  557 => 'dominatrix ',
  558 => 'dommes ',
  559 => 'donkey punch ',
  560 => 'double dong ',
  561 => 'double penetration ',
  562 => 'dp action ',
  563 => 'dry hump ',
  564 => 'dvda ',
  565 => 'eat my ass ',
  566 => 'ecchi ',
  567 => 'erotic ',
  568 => 'erotism ',
  569 => 'escort ',
  570 => 'eunuch ',
  571 => 'fecal ',
  572 => 'felch ',
  573 => 'feltch ',
  574 => 'female squirting ',
  575 => 'femdom ',
  576 => 'figging ',
  577 => 'fingerbang ',
  578 => 'fingering ',
  579 => 'fisting ',
  580 => 'foot fetish ',
  581 => 'footjob ',
  582 => 'frotting ',
  583 => 'fuck buttons ',
  584 => 'fucktards ',
  585 => 'futanari ',
  586 => 'gang bang ',
  587 => 'gay sex ',
  588 => 'genitals ',
  589 => 'giant cock ',
  590 => 'girl on ',
  591 => 'girl on top ',
  592 => 'girls gone wild ',
  593 => 'goatcx ',
  594 => 'god damn ',
  595 => 'gokkun ',
  596 => 'golden shower ',
  597 => 'goodpoop ',
  598 => 'goo girl ',
  599 => 'goregasm ',
  600 => 'grope ',
  601 => 'group sex ',
  602 => 'g-spot ',
  603 => 'guro ',
  604 => 'hand job ',
  605 => 'handjob ',
  606 => 'hard core ',
  607 => 'hardcore ',
  608 => 'hentai ',
  609 => 'homoerotic ',
  610 => 'honkey ',
  611 => 'hooker ',
  612 => 'hot carl ',
  613 => 'hot chick ',
  614 => 'how to kill ',
  615 => 'how to murder ',
  616 => 'huge fat ',
  617 => 'humping ',
  618 => 'incest ',
  619 => 'intercourse ',
  620 => 'jack off ',
  621 => 'jail bait ',
  622 => 'jailbait ',
  623 => 'jelly donut ',
  624 => 'jerk off ',
  625 => 'jigaboo ',
  626 => 'jiggaboo ',
  627 => 'jiggerboo ',
  628 => 'juggs ',
  629 => 'kike ',
  630 => 'kinbaku ',
  631 => 'kinkster ',
  632 => 'kinky ',
  633 => 'knobbing ',
  634 => 'leather restraint ',
  635 => 'leather straight jacket ',
  636 => 'lemon party ',
  637 => 'lolita ',
  638 => 'lovemaking ',
  639 => 'make me come ',
  640 => 'male squirting ',
  641 => 'menage a trois ',
  642 => 'milf ',
  643 => 'missionary position ',
  644 => 'mound of venus ',
  645 => 'mr hands ',
  646 => 'muff diver ',
  647 => 'muffdiving ',
  648 => 'nambla ',
  649 => 'nawashi ',
  650 => 'negro ',
  651 => 'neonazi ',
  652 => 'nig nog ',
  653 => 'nimphomania ',
  654 => 'nipple ',
  655 => 'nipples ',
  656 => 'nsfw images ',
  657 => 'nude ',
  658 => 'nudity ',
  659 => 'nympho ',
  660 => 'nymphomania ',
  661 => 'octopussy ',
  662 => 'omorashi ',
  663 => 'one cup two girls ',
  664 => 'one guy one jar ',
  665 => 'orgy ',
  666 => 'paedophile ',
  667 => 'paki ',
  668 => 'panties ',
  669 => 'panty ',
  670 => 'pedobear ',
  671 => 'pedophile ',
  672 => 'pegging ',
  673 => 'phone sex ',
  674 => 'piece of shit ',
  675 => 'piss pig ',
  676 => 'pisspig ',
  677 => 'playboy ',
  678 => 'pleasure chest ',
  679 => 'pole smoker ',
  680 => 'ponyplay ',
  681 => 'poof ',
  682 => 'poon ',
  683 => 'poontang ',
  684 => 'punany ',
  685 => 'poop chute ',
  686 => 'poopchute ',
  687 => 'prince albert piercing ',
  688 => 'pthc ',
  689 => 'pubes ',
  690 => 'queaf ',
  691 => 'queef ',
  692 => 'quim ',
  693 => 'raghead ',
  694 => 'raging boner ',
  695 => 'rape ',
  696 => 'raping ',
  697 => 'rapist ',
  698 => 'reverse cowgirl ',
  699 => 'rimjob ',
  700 => 'rosy palm ',
  701 => 'rosy palm and her 5 sisters ',
  702 => 'rusty trombone ',
  703 => 'sadism ',
  704 => 'santorum ',
  705 => 'scat ',
  706 => 'scissoring ',
  707 => 'sexo ',
  708 => 'sexy ',
  709 => 'shaved beaver ',
  710 => 'shaved pussy ',
  711 => 'shibari ',
  712 => 'shitblimp ',
  713 => 'shota ',
  714 => 'shrimping ',
  715 => 'skeet ',
  716 => 'slanteye ',
  717 => 's&m ',
  718 => 'snowballing ',
  719 => 'sodomize ',
  720 => 'sodomy ',
  721 => 'spic ',
  722 => 'splooge ',
  723 => 'splooge moose ',
  724 => 'spooge ',
  725 => 'spread legs ',
  726 => 'strap on ',
  727 => 'strapon ',
  728 => 'strappado ',
  729 => 'strip club ',
  730 => 'style doggy ',
  731 => 'suck ',
  732 => 'sucks ',
  733 => 'suicide girls ',
  734 => 'sultry women ',
  735 => 'swastika ',
  736 => 'swinger ',
  737 => 'tainted love ',
  738 => 'taste my ',
  739 => 'tea bagging ',
  740 => 'threesome ',
  741 => 'throating ',
  742 => 'tied up ',
  743 => 'tight white ',
  744 => 'titty ',
  745 => 'tongue in a ',
  746 => 'topless ',
  747 => 'towelhead ',
  748 => 'tranny ',
  749 => 'tribadism ',
  750 => 'tub girl ',
  751 => 'tubgirl ',
  752 => 'tushy ',
  753 => 'twink ',
  754 => 'twinkie ',
  755 => 'two girls one cup ',
  756 => 'undressing ',
  757 => 'upskirt ',
  758 => 'urethra play ',
  759 => 'urophilia ',
  760 => 'venus mound ',
  761 => 'vibrator ',
  762 => 'violet wand ',
  763 => 'vorarephilia ',
  764 => 'voyeur ',
  765 => 'wetback ',
  766 => 'wet dream ',
  767 => 'white power ',
  768 => 'wrapping men ',
  769 => 'wrinkled starfish ',
  770 => 'xx ',
  771 => 'yaoi ',
  772 => 'yellow showers ',
  773 => 'yiffy ',
  774 => 'zoophilia ',
  775 => 'a54 ',
  776 => 'buttmunch ',
  777 => 'donkeypunch ',
  778 => 'fleshflute ',
  779 => 'asswipe ',
  780 => 'hoee ',
  781 => 'bitchass ',
  782 => 'moo moo foo foo ',
  783 => 'trumped ',
  784 => 'assbag ',
  785 => 'assbandit ',
  786 => 'assbanger ',
  787 => 'assbite ',
  788 => 'assclown ',
  789 => 'asscock ',
  790 => 'asscracker ',
  791 => 'assface ',
  792 => 'assfuck ',
  793 => 'assgoblin ',
  794 => 'asshat ',
  795 => 'ass-hat ',
  796 => 'asshead ',
  797 => 'asshopper ',
  798 => 'ass-jabber ',
  799 => 'assjacker ',
  800 => 'asslick ',
  801 => 'asslicker ',
  802 => 'assmonkey ',
  803 => 'assmuncher ',
  804 => 'assnigger ',
  805 => 'asspirate ',
  806 => 'ass-pirate ',
  807 => 'assshit ',
  808 => 'assshole ',
  809 => 'asssucker ',
  810 => 'asswad ',
  811 => 'axwound ',
  812 => 'bampot ',
  813 => 'bitchtits ',
  814 => 'bitchy ',
  815 => 'bollox ',
  816 => 'brotherfucker ',
  817 => 'bumblefuck ',
  818 => 'butt plug ',
  819 => 'buttfucka ',
  820 => 'butt-pirate ',
  821 => 'buttfucker ',
  822 => 'chesticle ',
  823 => 'chinc ',
  824 => 'choad ',
  825 => 'chode ',
  826 => 'clitface ',
  827 => 'clitfuck ',
  828 => 'cockass ',
  829 => 'cockbite ',
  830 => 'cockburger ',
  831 => 'cockfucker ',
  832 => 'cockjockey ',
  833 => 'cockknoker ',
  834 => 'cockmaster ',
  835 => 'cockmongler ',
  836 => 'cockmongruel ',
  837 => 'cockmonkey ',
  838 => 'cocknose ',
  839 => 'cocknugget ',
  840 => 'cockshit ',
  841 => 'cocksmith ',
  842 => 'cocksmoke ',
  843 => 'cocksmoker ',
  844 => 'cocksniffer ',
  845 => 'cockwaffle ',
  846 => 'coochie ',
  847 => 'coochy ',
  848 => 'cooter ',
  849 => 'cracker ',
  850 => 'cumbubble ',
  851 => 'cumdumpster ',
  852 => 'cumguzzler ',
  853 => 'cumjockey ',
  854 => 'cumslut ',
  855 => 'cumtart ',
  856 => 'cunnie ',
  857 => 'cuntass ',
  858 => 'cuntface ',
  859 => 'cunthole ',
  860 => 'cuntrag ',
  861 => 'cuntslut ',
  862 => 'dago ',
  863 => 'deggo ',
  864 => 'dickbag ',
  865 => 'dickbeaters ',
  866 => 'dickface ',
  867 => 'dickfuck ',
  868 => 'dickfucker ',
  869 => 'dickhole ',
  870 => 'dickjuice ',
  871 => 'dickmilk ',
  872 => 'dickmonger ',
  873 => 'dicks ',
  874 => 'dickslap ',
  875 => 'dick-sneeze ',
  876 => 'dicksucker ',
  877 => 'dicksucking ',
  878 => 'dicktickler ',
  879 => 'dickwad ',
  880 => 'dickweasel ',
  881 => 'dickweed ',
  882 => 'dickwod ',
  883 => 'dike ',
  884 => 'dipshit ',
  885 => 'doochbag ',
  886 => 'dookie ',
  887 => 'douche ',
  888 => 'douchebag ',
  889 => 'douche-fag ',
  890 => 'douchewaffle ',
  891 => 'dumass ',
  892 => 'dumb ass ',
  893 => 'dumbass ',
  894 => 'dumbfuck ',
  895 => 'dumbshit ',
  896 => 'dumshit ',
  897 => 'fagbag ',
  898 => 'fagfucker ',
  899 => 'faggit ',
  900 => 'faggotcock ',
  901 => 'fagtard ',
  902 => 'flamer ',
  903 => 'fuckass ',
  904 => 'fuckbag ',
  905 => 'fuckboy ',
  906 => 'fuckbrain ',
  907 => 'fuckbutt ',
  908 => 'fuckbutter ',
  909 => 'fuckersucker ',
  910 => 'fuckface ',
  911 => 'fuckhole ',
  912 => 'fucknut ',
  913 => 'fucknutt ',
  914 => 'fuckoff ',
  915 => 'fuckstick ',
  916 => 'fucktard ',
  917 => 'fucktart ',
  918 => 'fuckup ',
  919 => 'fuckwad ',
  920 => 'fuckwitt ',
  921 => 'gay ',
  922 => 'gayass ',
  923 => 'gaybob ',
  924 => 'gaydo ',
  925 => 'gayfuck ',
  926 => 'gayfuckist ',
  927 => 'gaytard ',
  928 => 'gaywad ',
  929 => 'goddamnit ',
  930 => 'gooch ',
  931 => 'gook ',
  932 => 'gringo ',
  933 => 'guido ',
  934 => 'hard on ',
  935 => 'heeb ',
  936 => 'hoe ',
  937 => 'homodumbshit ',
  938 => 'jackass ',
  939 => 'jagoff ',
  940 => 'jerkass ',
  941 => 'jungle bunny ',
  942 => 'junglebunny ',
  943 => 'kooch ',
  944 => 'kootch ',
  945 => 'kraut ',
  946 => 'kunt ',
  947 => 'kyke ',
  948 => 'lameass ',
  949 => 'lardass ',
  950 => 'lesbian ',
  951 => 'lesbo ',
  952 => 'lezzie ',
  953 => 'mcfagget ',
  954 => 'mick ',
  955 => 'minge ',
  956 => 'muffdiver ',
  957 => 'munging ',
  958 => 'nigaboo ',
  959 => 'niglet ',
  960 => 'nut sack ',
  961 => 'panooch ',
  962 => 'peckerhead ',
  963 => 'penisbanger ',
  964 => 'penispuffer ',
  965 => 'pissed off ',
  966 => 'polesmoker ',
  967 => 'pollock ',
  968 => 'poonani ',
  969 => 'poonany ',
  970 => 'porch monkey ',
  971 => 'porchmonkey ',
  972 => 'punanny ',
  973 => 'punta ',
  974 => 'pussylicking ',
  975 => 'puto ',
  976 => 'queer ',
  977 => 'queerbait ',
  978 => 'queerhole ',
  979 => 'renob ',
  980 => 'ruski ',
  981 => 'sand nigger ',
  982 => 'sandnigger ',
  983 => 'shitbag ',
  984 => 'shitbagger ',
  985 => 'shitbrains ',
  986 => 'shitbreath ',
  987 => 'shitcanned ',
  988 => 'shitcunt ',
  989 => 'shitface ',
  990 => 'shitfaced ',
  991 => 'shithole ',
  992 => 'shithouse ',
  993 => 'shitspitter ',
  994 => 'shitstain ',
  995 => 'shittiest ',
  996 => 'shiz ',
  997 => 'shiznit ',
  998 => 'skullfuck ',
  999 => 'slutbag ',
  1000 => 'smeg ',
  1001 => 'spick ',
  1002 => 'spook ',
  1003 => 'suckass ',
  1004 => 'tard ',
  1005 => 'thundercunt ',
  1006 => 'twatlips ',
  1007 => 'twats ',
  1008 => 'twatwaffle ',
  1009 => 'unclefucker ',
  1010 => 'vag ',
  1011 => 'vajayjay ',
  1012 => 'va-j-j ',
  1013 => 'vjayjay ',
  1014 => 'wankjob ',
  1015 => 'whorebag ',
  1016 => 'whoreface ',
  1017 => 'wop ',
  1018 => 'fuck you ',
  1019 => 'piss off ',
  1020 => 'dick head ',
  1021 => 'bloody hell ',
  1022 => 'crikey ',
  1023 => 'rubbish ',
  1024 => 'taking the piss ',
  1025 => 'jerk ',
  1026 => 'knob end ',
  1027 => 'lmao ',
  1028 => 'omfg ',
  1029 => 'wtf ',
  1030 => 'bint ',
  1031 => 'ginger ',
  1032 => 'git ',
  1033 => 'minger ',
  1034 => 'munter ',
  1035 => 'sod off ',
  1036 => 'chinky ',
  1037 => 'choc ice ',
  1038 => 'gippo ',
  1039 => 'golliwog ',
  1040 => 'hun ',
  1041 => 'iap ',
  1042 => 'jock ',
  1043 => 'nig-nog ',
  1044 => 'pikey ',
  1045 => 'polack ',
  1046 => 'sambo ',
  1047 => 'slope ',
  1048 => 'spade ',
  1049 => 'taff ',
  1050 => 'wog ',
  1051 => 'beaver ',
  1052 => 'beef curtains ',
  1053 => 'bloodclaat ',
  1054 => 'clunge ',
  1055 => 'flaps ',
  1056 => 'gash ',
  1057 => 'punani ',
  1058 => 'batty boy ',
  1059 => 'bender ',
  1060 => 'bum boy ',
  1061 => 'bumclat ',
  1062 => 'bummer ',
  1063 => 'chi-chi man ',
  1064 => 'chick with a dick ',
  1065 => 'fudge-packer ',
  1066 => 'gender bender ',
  1067 => 'he-she ',
  1068 => 'lezza/lesbo ',
  1069 => 'pansy ',
  1070 => 'shirt lifter ',
  1071 => 'cretin ',
  1072 => 'cripple ',
  1073 => 'div ',
  1074 => 'looney ',
  1075 => 'midget ',
  1076 => 'mong ',
  1077 => 'nutter ',
  1078 => 'psycho ',
  1079 => 'schizo ',
  1080 => 'veqtable ',
  1081 => 'window licker ',
  1082 => 'fenian ',
  1083 => 'kafir ',
  1084 => 'prod ',
  1085 => 'taig ',
  1086 => 'yid ',
  1087 => 'iberian slap ',
  1088 => 'middle finger ',
  1089 => 'two fingers with tongue ',
  1090 => 'two fingers ',
  1091 => 'nonce ',
  1092 => 'prickteaser ',
  1093 => 'rapey ',
  1094 => 'slag ',
  1095 => ' g a y',
  1096 => 'coffin dodger ',
  1097 => 'old bag ',
  1098 => 'frenchify ',
  1099 => 'bescumber ',
  1100 => 'microphallus ',
  1101 => 'coccydynia ',
  1102 => 'ninnyhammer ',
  1103 => 'buncombe ',
  1104 => 'hircismus ',
  1105 => 'corpulent ',
  1106 => 'feist ',
  1107 => 'fice ',
  1108 => 'cacafuego ',
  1109 => 'ass fuck ',
  1110 => 'assfaces ',
  1111 => 'assmucus ',
  1112 => 'bang (one\'s) box ',
  1113 => 'bastards ',
  1114 => 'beef curtain ',
  1115 => 'bitch tit ',
  1116 => 'blow me ',
  1117 => 'blow mud ',
  1118 => 'blue waffle ',
  1119 => 'blumpkin ',
  1120 => 'bust a load ',
  1121 => 'butt fuck ',
  1122 => 'choade ',
  1123 => 'chota bags ',
  1124 => 'clit licker ',
  1125 => 'clitty litter ',
  1126 => 'cock pocket ',
  1127 => 'cock snot ',
  1128 => 'cocksuck,cocksucked ',
  1129 => 'cocksuckers ',
  1130 => 'cocksucks,cop some wood" ',
  1131 => 'cornhole ',
  1132 => 'corp whore ',
  1133 => 'cum chugger ',
  1134 => 'cum dumpster ',
  1135 => 'cum freak ',
  1136 => 'cum guzzler ',
  1137 => 'cumdump ',
  1138 => 'cunt hair ',
  1139 => 'cuntbag ',
  1140 => 'cuntlick,cuntlicker ',
  1141 => 'cuntlicking,cuntsicle" ',
  1142 => 'cunt-struck ',
  1143 => 'cut rope ',
  1144 => 'cyberfuck,cyberfucked ',
  1145 => 'cyberfucking,dick hole" ',
  1146 => 'dick shy ',
  1147 => 'dickheads ',
  1148 => 'dirty Sanchez ',
  1149 => 'eat a dick ',
  1150 => 'eat hair pie ',
  1151 => 'ejaculates,ejaculating" ',
  1152 => 'facial ',
  1153 => 'faggots ',
  1154 => 'fingerfuck,fingerfucked ',
  1155 => 'fingerfucker,fingerfucking ',
  1156 => 'fingerfucks,fist fuck" ',
  1157 => 'fistfucked,fistfucker ',
  1158 => 'fistfuckers,fistfucking ',
  1159 => 'fistfuckings,fistfucks ',
  1160 => 'flog the log ',
  1161 => 'fuc ',
  1162 => 'fuck hole ',
  1163 => 'fuck puppet ',
  1164 => 'fuck trophy ',
  1165 => 'fuck yo mama ',
  1166 => 'fuck ',
  1167 => 'fuck-ass ',
  1168 => 'fuck-bitch ',
  1169 => 'fuckedup ',
  1170 => 'fuckme,fuckmeat" ',
  1171 => 'fucktoy ',
  1172 => 'fukkers ',
  1173 => 'fuq ',
  1174 => 'gang-bang ',
  1175 => 'gassy ass ',
  1176 => 'god ',
  1177 => 'ham flap ',
  1178 => 'how to murdep ',
  1179 => 'jackasses ',
  1180 => 'jiz,jizm ',
  1181 => 'kinky Jesus ',
  1182 => 'kwif ',
  1183 => 'LEN ',
  1184 => 'mafugly ',
  1185 => 'mothafucked,mothafucking ',
  1186 => 'mother fucker ',
  1187 => 'muff puff ',
  1188 => 'need the dick ',
  1189 => 'nut butter ',
  1190 => 'pisses,pissin ',
  1191 => 'pissoff,pussy fart" ',
  1192 => 'pussy palace ',
  1193 => 'queaf ',
  1194 => 'sandbar ',
  1195 => 'sausage queen ',
  1196 => 'shit fucker ',
  1197 => 'shitheads ',
  1198 => 'shitters,shittier" ',
  1199 => 'slope ',
  1200 => 'slut bucket ',
  1201 => 'smartass ',
  1202 => 'smartasses ',
  1203 => 'tit wank ',
  1204 => 'tities ',
  1205 => 'wiseass ',
  1206 => 'wiseasses ',
  1207 => 'boong ',
  1208 => 'coonnass ',
  1209 => 'darn ',
  1210 => 'Breeder ',
  1211 => 'Cocklump ',
  1212 => 'Doublelift ',
  1213 => 'Dumbcunt ',
  1214 => 'Fuck off ',
  1215 => 'Poopuncher ',
  1216 => 'Sandler ',
  1217 => 'cockeye ',
  1218 => 'crotte ',
  1219 => 'KKK',
  1220 => 'foah ',
  1221 => 'fucktwat ',
  1222 => 'jaggi ',
  1223 => 'kunja ',
  1224 => 'pust ',
  1225 => 'sanger ',
  1226 => 'seks ',
  1227 => 'zubb ',
  1228 => 'zibbi ',
  1229 => 'fucc ',
  1230 => 'succ ',
  1231 => 'nibba',
  1232 => 'dildo',
  1233 => 'penis',
  1233 => 'gay',
  1233 => 'fuck',
);
    $cleaned = str_ireplace($words, "**** ", $string);
    return $cleaned;
}
?>