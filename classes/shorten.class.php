<?php
/**
 *
 *  * Copyright (c) 2020.
 *  * Created By RaithSphere
 *  * License: http://creativecommons.org/licenses/by/3.0/
 *
 */

namespace shortner;

/**
 * Class short
 * @package shortner
 */
class short
{
    /**
     * @var string
     */
    public string $db_host;
    /**
     * @var string
     */
    public string $username;
    /**
     * @var string
     */
    public string $password;
    /**
     * @var string
     */
    public string $database;
    /**
     * @var string
     */
    public string $table;
    /**
     * @var false|\mysqli
     */
    private $connection;

    /**
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     * @param $table
     */
    function InitDB($host, $username, $password, $database, $table)
    {
        $this->db_host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->table = $table;
    }

    /**
     * @return string
     */
    function generateUrlId()
    {
        $adj = array("Wellmade", "Blushing", "Small", "Playful", "Pertinent", "Closed", "Zany", "Hardtofind", "Nifty", "Considerate", "Elderly", "Affectionate", "Whirlwind", "Frayed", "Gray", "Insubstantial", "Scratchy", "Flippant", "Secret", "Shady", "Tender", "Interesting", "Stormy", "Cogent", "Placid", "Lucky", "Disastrous", "Every", "Lined", "Unripe", "Somber", "Faraway", "These", "Harmonious", "Sharp", "Anguished", "Unpleasant", "Jaunty", "Vicious", "Abnegate", "Cracky", "Hyper", "Genius", "Abstemious", "Freezing", "Jazzy", "Cultured", "Flirty", "Busy", "Deaf", "Benevolent", "Abstruse", "Sweet", "Affluent", "Wild", "Hairy", "Alienated", "Imaginative", "Polished", "Tempting", "Watchful", "Wavy", "Broken", "Responsible", "Illiterate", "Disfigured", "Scientific", "Oblong", "Back", "Rectangular", "Inspiring", "Blazing", "Sincere", "Enjoyable", "Entertaining", "Onerous", "Rough", "Round", "Frozen", "Manly", "Smoky", "Ephemeral", "Trustworthy", "Bashful", "Litigious", "Proud", "Whispered", "Hedonistic", "Whopping", "Rocky", "Spoopy", "Boxy", "Moldy", "Spunky", "Observant", "Renowned", "Resolute", "Spooky", "Lovely", "Astute", "Expensive", "Endearing", "Callous", "Flaccid", "Kawaii", "Abrasive", "Ironic", "Tacit", "Seductive", "Modern", "Kathish", "Resourceful", "Apathetic", "Fit", "Unhealthy", "Amazonian", "Humble", "Artsy", "Suspicious", "Bumbling", "Periodic", "Rude", "Productive", "Encouraging", "Attractive", "Bloody", "Slushy", "Hungry", "Steamy", "Gargantuan", "Bossy", "Energetic", "Vengeful", "Fancy", "Teeming", "Fatal", "Smoggy", "Sore", "Tart", "Taut", "Polite", "Bighearted", "Late", "Haunting", "Sleepy", "Wellworn", "Famous", "Salty", "Young", "Definite", "Diligent", "Frequent", "Quick", "Free", "Grouchy", "Offensive", "Silky", "Unique", "Regular", "Secondhand", "Victorious", "Zesty", "Some", "Verifiable", "Wellinformed", "Welllit", "Vibrant", "Warm", "Infantile", "Welcome", "Minty", "Wilted", "Improbable", "Windy", "Wet", "General", "Remarkable", "Melodic", "Hearty", "Short", "Rewarding", "Big", "Ancient", "Content", "Excellent", "Flickering", "Constant", "Gifted", "Hospitable", "Passionate", "Healthy", "Hopeful", "Memorable", "Scared", "Joyful", "Sentimental", "Wellgroomed", "Weak", "Clever", "Peppery", "Yellow", "Tight", "Selfreliant", "Serene", "Speedy", "Thin", "Goodnatured", "Thoughtful", "Plush", "Satisfied", "Scary", "Weepy", "Yearly", "Specific", "Adventurous", "Courageous", "Selfassured", "Vapid", "Exemplary", "Coarse", "Wealthy", "Giant", "Firm", "Bountiful", "Flawless", "Grim", "Clean", "Any", "Boring", "Smooth", "Massive", "Discrete", "Feline", "Hard", "Terrible", "Identical", "Ill", "Immediate", "Jaded", "Impressive", "Antique", "Apprehensive", "Evergreen", "Filthy", "Aged", "Welloff", "Baggy", "Bare", "Candid", "Celebrated", "Comfortable", "Crafty", "Farflung", "Glamorous", "Jampacked", "Magnificent", "Meager", "Precious", "Prestigious", "Spectacular", "Spry", "Thrifty", "Severe", "Shameless", "Circular", "Faroff", "United", "Lively", "Gigantic", "Large", "Wasteful", "Actual", "Shiny", "Complete", "Tan", "Testy", "Appropriate", "Thorough", "Shallow", "Silver", "Total", "Unacceptable", "Uneven", "Enchanting", "Unnatural", "Delightful", "Untried", "Costly", "Unfinished", "Beautiful", "Thunderous", "All", "Another", "Bowed", "Clear", "Calculating", "Flustered", "Oddball", "Possible", "Unconscious", "Safe", "Crazy", "Important", "Legal", "Sizzling", "Sorrowful", "Tired", "White", "Zigzag", "Organic", "Careless", "Cool", "Creepy", "Enraged", "Equal", "Favorable", "Pointless", "Fluid", "Glistening", "Kindhearted", "Limping", "Masculine", "Orange", "Palatable", "Villainous", "Welltodo", "Which", "Whimsical", "Wideeyed", "Decent", "Defiant", "Shameful", "Yellowish", "Wiggly", "Willing", "Slim", "Tattered", "Digital", "Fitting", "Vain", "Last", "Bleak", "Tidy", "Bruised", "Cooperative", "Dreary", "Forsaken", "Heavenly", "Pleased", "Ragged", "Untimely", "Unequaled", "Acrobatic", "Advanced", "Agile", "Ambitious", "Enlightened", "Brave", "Difficult", "Fatherly", "Fine", "Frigid", "Jovial", "Lighthearted", "Long", "Merry", "Necessary", "Rash", "Remote", "Several", "Obedient", "Shortterm", "Sparse", "Respectful", "Tame", "Tasty", "Thick", "Tinted", "Unhappy", "Yawning", "Wee", "Weighty", "Lame", "Odd", "Fluffy", "Angry", "Recent", "Cavernous", "Hateful", "Inconsequential", "Nimble", "Flimsy", "Babyish", "Finished", "Better", "Hollow", "Disgusting", "Misguided", "Near", "Ready", "Elliptical", "Immaculate", "Gripping", "Cooked", "Happygolucky", "Inexperienced", "Fake", "Colorful", "Apt", "Assured", "Annual", "Bad", "Bogus", "Classic", "Blank", "Fat", "High", "Insistent", "Crisp", "Decimal", "Distant", "Faint", "Blissful", "Fantastic", "Good", "Grounded", "Honest", "Horrible", "Impractical", "Insignificant", "Keen", "Klutzy", "Likable", "Aching", "Graceful", "Mediocre", "Mild", "Next", "Past", "Rich", "Shocking", "Splendid", "Tepid", "Unlawful", "Infatuated", "Elastic", "Perfect", "Essential", "Snoopy", "Barren", "Gross", "Sophisticated", "Serpentine", "Faithful", "Defensive", "Joint", "Deficient", "Flaky", "Livid", "Detailed", "Brown", "Cheap", "Afraid", "Angelic", "Both", "Bright", "Calm", "Dark", "Great", "Heavy", "Madeup", "Close", "Elementary", "Meek", "Exalted", "Flat", "Gleeful", "Terrific", "Idealistic", "Kind", "Lasting", "Lean", "Orderly", "Jealous", "Positive", "Tall", "Colorless", "Misty", "Real", "Required", "Secondary", "Sick", "Smug", "Sniveling", "Spirited", "Tedious", "Bitesized", "Pesky", "Few", "Indolent", "Downright", "Ashamed", "Dense", "Radiant", "Mature", "Male", "Deafening", "Scaly", "Second", "Phony", "Aggravating", "Animated", "Beloved", "Active", "Cautious", "Cheerful", "Damaged", "Familiar", "Far", "Gaseous", "Focused", "Immaterial", "Grandiose", "Major", "Mealy", "Only", "Idolized", "Accomplished", "Mad", "Biodegradable", "Clumsy", "Posh", "Common", "Dependable", "Dimwitted", "Disloyal", "Flawed", "Homely", "Hot", "Majestic", "Offbeat", "Sarcastic", "Shrill", "Disguised", "Mean", "Nervous", "Cloudy", "Gregarious", "Hilarious", "Favorite", "Charming", "Leading", "Medium", "Imaginary", "Red", "Acclaimed", "Personal", "Anxious", "Arid", "Emotional", "Foolhardy", "Shocked", "Shoddy", "Oily", "Exhausted", "Smart", "Measly", "Criminal", "Elaborate", "Alarmed", "Ample", "Bewitched", "Blackandwhite", "Clueless", "Dependent", "Deserted", "Idiotic", "Impeccable", "Imperfect", "Negative", "Potable", "Relieved", "Spicy", "Violet", "Weary", "Wide", "Insidious", "Daring", "Perky", "Ignorant", "Lone", "Illegal", "Blaring", "Brilliant", "Devoted", "Innocent", "Female", "French", "Gentle", "Imperturbable", "That", "Slimy", "Impolite", "Formal", "Alive", "Illustrious", "Glossy", "Golden", "Dopey", "Talkative", "Menacing", "Raw", "Soupy", "Adorable", "Astonishing", "Winding", "Bland", "Colossal", "Fearful", "Handsome", "Highlevel", "Incredible", "Inferior", "Neat", "Neighboring", "Paltry", "Poised", "Right", "Sad", "Snarling", "Similar", "Complicated", "Frightening", "Clearcut", "Ordinary", "Delectable", "Chilly", "Darling", "Distorted", "Euphoric", "Greedy", "Neglected", "Dismal", "Black", "Remorseful", "Unselfish", "Wicked", "Corny", "Heartfelt", "Unlucky", "Minor", "Velvety", "Handy", "Delayed", "Mammoth", "Able", "Adept", "Envious", "Altruistic", "Dirty", "Pleasant", "Equatorial", "Forceful", "Hefty", "Repentant", "Lanky", "Linear", "Miniature", "Nippy", "Opulent", "Sandy", "Scented", "Soft", "Bouncy", "Reflecting", "Silent", "Solid", "Pale", "Eager", "Political", "Harsh", "Conscious", "Earnest", "Icy", "Ringed", "Messy", "Cold", "Spiteful", "Plaintive", "Honorable", "Plump", "Confused", "Enormous", "Impartial", "Excitable", "Easy", "Key", "Dimpled", "Glass", "Valid", "Impossible", "Grotesque", "Negligible", "Each", "Brisk", "Glum", "Grizzled", "Helpless", "Ajar", "Anchored", "Cheery", "Forthright", "Bony", "Different", "Dim", "Glittering", "Direct", "Giving", "Dizzy", "Easygoing", "Embarrassed", "Blue", "Carefree", "Icky", "Piercing", "Feisty", "Feminine", "Quarterly", "Grand", "Grateful", "Jubilant", "Repulsive", "Ripe", "Shimmering", "Handmade", "Parched", "Quarrelsome", "Revolving", "Slight", "Immense", "Dazzling", "Incompatible", "Legitimate", "Petty", "Loathsome", "Amusing", "Firsthand", "Pointed", "Old", "Portly", "Accurate", "First", "Corrupt", "Scholarly", "Realistic", "Naive", "Delirious", "Fast", "Inborn", "Needy", "Reliable", "Valuable", "Unlined", "Best", "Scarce", "Same", "Venerated", "Vigorous", "Webbed", "Shy", "Brief", "Failing", "Fragrant", "Incomparable", "Open", "Ultimate", "Spotless", "Wan", "Jittery", "Informal", "Whole", "Agonizing", "Flowery", "Amused", "Blind", "Dental", "Mindless", "Harmless", "Determined", "Ornate", "Ecstatic", "Impassioned", "Regal", "Light", "Metallic", "Physical", "Plain", "Powerful", "Sane", "Fortunate", "Granular", "Slippery", "Hidden", "Honored", "Infinite", "Miserable", "Thankful", "Narrow", "Nasty", "Naughty", "Nautical", "Vague", "Variable", "Warlike", "Perfumed", "Breakable", "Reckless", "Simplistic", "Sparkling", "Those", "Unimportant", "Unknown", "Weekly", "Reasonable", "Zealous", "Demanding", "Ideal", "Official", "Compassionate", "Scrawny", "Rare", "Half", "Spherical", "Fond", "Descriptive", "Early", "Knobby", "Simple", "Composed", "Canine", "Generous", "Creamy", "Absolute", "Foolish", "Gleaming", "Impish", "Incomplete", "Medical", "Peaceful", "Agreeable", "Aromatic", "Pink", "Pleasing", "Powerless", "Grimy", "Sinful", "Married", "Qualified", "Silly", "Snappy", "Soulful", "Obvious", "Third", "Spotted", "Understated", "Popular", "Abandoned", "Rapid", "Unfolded", "Single", "Spiffy", "Unruly", "Illinformed", "Unsightly", "Chief", "Jolly", "Skeletal", "Belated", "Cluttered", "Parallel", "Bitter", "Unkempt", "Huge", "Deadly", "Instructive", "New", "Warped", "Complex", "Occasional", "Mellow", "Acceptable", "Queasy", "Flamboyant", "Thorny", "Artistic", "Blond", "Gloomy", "Entire", "Everlasting", "Indelible", "Enchanted", "Boiling", "Arctic", "Present", "Damp", "Liquid", "Coordinated", "Conventional", "Courteous", "Elegant", "Admired", "Joyous", "Embellished", "Alert", "Frail", "Pessimistic", "Friendly", "False", "Harmful", "Frank", "Sardonic", "Meaty", "Shabby", "Querulous", "Weird", "Basic", "Partial", "Bronze", "Careful", "Dead", "Deep", "Impressionable", "Eminent", "Torn", "Leafy", "Mixed", "Vast", "Selfish", "Insecure", "Unaware", "Esteemed", "Electric", "Watery", "Concerned", "Creative", "Edible", "Even", "Dangerous", "Hasty", "Fixed", "Bold", "Optimal", "Defenseless", "Nice", "Educated", "Elated", "Glaring", "Impure", "Jagged", "Obese", "Left", "Tense", "Admirable", "Dishonest", "Scornful", "Shadowy", "Distinct", "Green", "Spanish", "Flashy", "Unfit", "Genuine", "Unsteady", "Untidy", "Helpful", "Lonely", "Athletic", "Aggressive", "Questionable", "Skinny", "Agitated", "Adolescent", "Glorious", "Threadbare", "Pastel", "Dearest", "Kindly", "Idle", "Lawful", "Oldfashioned", "Miserly", "Separate", "Tangible", "Thirsty", "Serious", "Timely", "Fair", "Delicious", "Caring", "Pitiful", "Tiny", "Ugly", "Uniform", "Competent", "Wary", "Kaleidoscopic", "Sour", "Infamous", "Happy", "Adored", "Alarming", "Capital", "Amazing", "Academic", "Live", "Soggy", "Ethical", "Dear", "Empty", "Optimistic", "Fearless", "Evil", "Fickle", "Uncomfortable", "Likely", "Vigilant", "Marvelous", "Unrealistic", "Little", "Quaint", "Frightened", "Lazy", "Definitive", "Welldocumented", "Hoarse", "Decisive", "Limp", "Natural", "Acidic", "Fresh", "Vacant", "Beneficial", "Chubby", "Limited", "Rigid", "Giddy", "Milky", "Poor", "Unfortunate", "Lavish", "Forked", "Concrete", "Fabulous", "Gorgeous", "Ornery", "Dapper", "Gracious", "Grave", "Plastic", "Hideous", "Slow", "Illfated", "Practical", "Showy", "Sneaky", "Warmhearted", "Sociable", "Uncommon", "Unsung", "Waterlogged");

        $ani = array("BantamRooster", "Amphiuma", "IbizanHound", "AfricanPorcupine", "AdmiralButterfly", "Civet", "AldabraTortoise", "Fluke", "Beetle", "AbyssinianGroundHornbill", "Akitainu", "Caecilian", "Goose", "BeardedDragon", "Antlion", "BlackWidowSpider", "AmericanBobtail", "Cuttlefish", "CornSnake", "Iguanodon", "ArrowWorm", "BlueAndGoldMackaw", "DartFrog", "IzuThrush", "Amoeba", "Ichthyosaurs", "Crustacean", "AcornWoodpecker", "Leafhopper", "Deinonychus", "IberianBarbel", "Bettong", "Giraffe", "Elephant", "AfricanFishEagle", "Bonobo", "DiamondbackRattlesnake", "FlickertailSquirrel", "FlyingSquirrel", "Godwit", "GuineaPig", "Caterpillar", "Chihuahua", "DuckbillPlatypus", "Genet", "Cygnet", "FennecFox", "Bull", "Armyant", "EuropeanFireSalamander", "Elk", "ChimneySwift", "Lice", "HectorsDolphin", "FairyBluebird", "IslandWhistler", "ItalianGreyhound", "Kangaroo", "Killifish", "Lark", "Emu", "BlueWhale", "Deer", "HanumanMonkey", "AfricanMoleSnake", "ImperatorAngel", "Gharial", "Dunlin", "Isopod", "Javalina", "Ichthyostega", "Jellyfish", "LhasaApso", "KillerWhale", "Crane", "Aardvark", "Kinkajou", "Kitten", "Kronosaurus", "Hadrosaurus", "Gaur", "Baiji", "AntelopeGroundSquirrel", "Bandicoot", "Foal", "Earwig", "Bluebird", "Coelacanth", "Copperhead", "Goldfinch", "Cottonmouth", "Gyrfalcon", "GraySquirrel", "IcelandicSheepdog", "Grosbeak", "AtlanticBlueTang", "Blobfish", "AlligatorGar", "Goat", "Human", "Goral", "Ape", "Grunion", "Chimpanzee", "KarakulSheep", "GalapagosDove", "Coot", "Balloonfish", "Appaloosa", "Guppy", "ArabianHorse", "AltiplanoChinchillaMouse", "Hagfish", "CommonGonolek", "AfricanElephant", "Goldfish", "Hedgehog", "Barbet", "ArcticSeal", "Hornet", "Cockatoo", "CraneFly", "FoxTerrier", "Grasshopper", "Guineafowl", "HarbourPorpoise", "Bear", "AustralianKestrel", "AnophelesMosquito", "FieldSpaniel", "Devilfish", "Butterfly", "Egg", "AtlanticBlackgoby", "Eider", "Albertosaurus", "Leveret", "AfricanGroundHornbill", "Bactrian", "Argali", "Goa", "Albino", "CommaButterfly", "Cony", "CopperButterfly", "IbadanMalimbe", "EidolonHelvum", "Crocodile", "EmperorShrimp", "Ewe", "EyelashPitViper", "Cottontail", "Bluet", "Ferret", "Crossbill", "FinnishSpitz", "AlaskanMalamute", "Flee", "Finch", "Cub", "IberianMole", "Dassie", "HermitCrab", "FlatCoatRetriever", "IndigoWingedParrot", "DungBeetle", "DraftHorse", "Drake", "EasternNewt", "Bird", "IvoryBackedWoodswallow", "AmethystinePython", "BlackRussianTerrier", "Firecrest", "Kite", "Fish", "ArcticWolf", "BighornedSheep", "AustralianFreshwaterCrocodile", "DanishSwedishFarmdog", "Flicker", "HorseChestnutLeafMiner", "Huemul", "Budgie", "LeopardSeal", "Kiskadee", "LeafcutterAnt", "Leafbird", "Discus", "Cod", "Coqui", "Coral", "Cow", "CrownOfThornsStarfish", "Hartebeest", "ElectricEel", "Insect", "EskimoDog", "Ibex", "EthiopianWolf", "EuropeanPoleCat", "Kingbird", "IrishDraughtHorse", "Lamb", "Impala", "IndianPalmSquirrel", "Hummingbird", "HawaiianMonkSeal", "Ichidna", "Jaeger", "Jabiru", "Flycatcher", "Antbear", "Antelope", "Arachnid", "Arawana", "ArgusFish", "AsianDamselfly", "Hawk", "GalapagosTortoise", "AustralianCurlew", "AustralianKelpie", "BlackLab", "Incatern", "BlackNorwegianElkhound", "Boa", "IceBlueRedTopZebra", "CaimanLizard", "Calf", "Chameleon", "ClownAnemonefish", "IberianMidwifeToad", "IndianCow", "ItalianBrownBear", "KoalaBear", "Larva", "EstuarineCrocodile", "FanWorms", "BoaConstrictor", "Koala", "Gelada", "Jaguar", "AntarcticGiantPetrel", "ArizonaAlligatorLizard", "HarvestMouse", "IndianaBat", "AndeanCat", "Anura", "FrilledLizard", "Archaeopteryx", "ArielToucan", "AsianElephant", "AsiaticGreaterFreshwaterClam", "IndigoBunting", "Haddock", "AsiaticLesserFreshwaterClam", "Halcyon", "Asp", "Avians", "AxisDeer", "Hoverfly", "Axolotl", "GreatHornedOwl", "Horse", "Barracuda", "GoldenEye", "Basil", "InchWorm", "IcelandGull", "GypsyMoth", "Herring", "Hind", "ArabianWildcat", "KissingBug", "Killdeer", "Hart", "BlackPanther", "IrishRedAndWhiteSetter", "AsianSmallClawedOtter", "Borer", "Goshawk", "Camel", "AchillesTang", "Aidi", "AiredaleTerrier", "AlpineGoat", "AmericanCicada", "AmericanRiverOtter", "AmericanWarmblood", "AmericanWigeon", "Capybara", "Cardinal", "Cassowary", "Cero", "CleanerWrasse", "Cormorant", "CorydorasCatfish", "Creature", "Langur", "Airedale", "AmericanWirehair", "Amphibian", "Gerbil", "Heterodontosaurus", "AmethystSunbird", "ImperialEagle", "AmurStarfish", "Angora", "Eel", "ArabianOryx", "BluetickCoonhound", "Cat", "Kakarikis", "AsianTrumpetfish", "AfricanJacana", "AfricanRockPython", "Agouti", "AlaskanHusky", "AmericanAlligator", "AplomadoFalcon", "AmericanCrayfish", "Fawn", "Cusimanse", "Bullfrog", "Ladybird", "Gemsbuck", "AmericanCurl", "Heifer", "AmericanGoldfinch", "HorseshoeCrab", "AsianWaterBuffalo", "Globefish", "Hogget", "Hypsilophodon", "IchneumonFly", "IndianSpinyLoach", "AmericanQuarterHorse", "AmericanRedSquirrel", "Lemming", "AsiaticMouflon", "Kob", "AtlanticSharpnosePuffer", "Auklet", "Avocet", "Aztecant", "BaldEagle", "BlackCrappie", "Caracal", "Indri", "Clingfish", "FatTailedDunnart", "Bunny", "AmericanBittern", "Janenschia", "Leafwing", "GalapagosMockingbird", "GermanShepherd", "IcterineWarbler", "Inganue", "Kakapo", "IvoryBilledWoodpecker", "Kudu", "Jackal", "Kentrosaurus", "Jaguarundi", "Kitty", "Kusimanse", "KodiakBear", "AfricanWildcat", "KomodoDragon", "LabradorRetriever", "Duiker", "Lemur", "Kiwi", "Hatchetfish", "AmericanBlackVulture", "AsiaticWildAss", "Bats", "Beagle", "Beauceron", "Binturong", "Cats", "Chuckwalla", "DavidsTiger", "DevilTasmanian", "DoctorFish", "Dodobird", "Dolphin", "DouglasFirBarkBeetle", "DungenessCrab", "EastRussianCoursingHounds", "IndianRockPython", "Junebug", "IrishSetter", "Kestrel", "Liger", "Ibisbill", "Barb", "BedBug", "BillyGoat", "BirdOfParadise", "BlackFootedFerret", "BorderCollie", "Brant", "BrocketDeer", "Buck", "Chick", "Chrysalis", "Cirriped", "Clumber", "Cobra", "Cricket", "CrocodileSkink", "Curassow", "Gadwall", "GalapagosAlbatross", "GardenSnake", "Gecko", "GermanWirehairedPointer", "Gnu", "Gosling", "GossamerWingedButterfly", "GrizzlyBear", "Grouse", "Hairstreak", "Halibut", "FallowDeer", "HornedToad", "HorseMouse", "Hound", "Husky", "Hydra", "Hyena", "Hyrax", "IaerisMetalmark", "IberianChiffchaff", "Imago", "IndianElephant", "IndianRingneckParakeet", "AlpineRoadguideTigerBeetle", "Falcon", "Elver", "IndianSkimmer", "BigHorn", "AmazonTreeBoa", "IndochinaHogDeer", "Frogmouth", "DikDik", "FrenchBulldog", "Koi", "AmericanCrow", "HammerheadShark", "HarborSeal", "IntermediateEgret", "IranianGroundJay", "HarpSeal", "HarpyEagle", "Harrier", "Hen", "Hoki", "Homalocephale", "HoneyBadger", "IrishWaterSpaniel", "Leopard", "Leonberger", "Leech", "ApisDorsataLaboriosa", "Fairyfly", "ArmedNylonShrimp", "DairyCow", "Dotterel", "IndusRiverDolphin", "GilaMonster", "Cur", "Baboon", "Ant", "Cattle", "Kingfisher", "FireAnt", "FieldMouse", "ArgentineHornedFrog", "AttwatersPrairieChicken", "Harvestmen", "AfricanClawedFrog", "Krill", "BarnOwl", "Goitered", "HydatidTapeworm", "BettaFish", "Kittiwake", "Cooter", "Cowbird", "Ladybug", "Gar", "AustrianPinscher", "Flatfish", "AsianLion", "AfricanPiedKingfisher", "Basilisk", "Conure", "Dachshund", "DaddyLonglegs", "DogwoodTwigBorer", "Drongo", "Ermine", "Fugu", "Gallinule", "ArgentineRuddyDuck", "Galago", "GarterSnake", "Geese", "GermanSpitz", "GrassSpider", "GreatArgus", "GuernseyCow", "HookerSeaLion", "Hornbill", "IberianNase", "Illadopsis", "IndianGlassfish", "IndianJackal", "BlueJay", "IndochineseTiger", "IvoryGull", "Jay", "Jerboa", "AmurMinnow", "DwarfMongoose", "Hare", "Badger", "BlackFly", "Boto", "Adouri", "Ankole", "AustralianCattleDog", "Barasingha", "BedlingtonTerrier", "Blackbird", "Blowfish", "Bluegill", "BrownBear", "Catbird", "Hippopotamus", "Chicken", "Clam", "CockerSpaniel", "BoilWeevil", "AtlanticSpadefish", "GermanSpaniel", "Gibbon", "Earthworm", "GordonSetter", "Hellbender", "Equestrian", "Eyra", "Aardwolf", "HammerheadBird", "AegeanCat", "Guillemot", "GalapagosHawk", "Hoatzin", "Hylaeosaurus", "Halicore", "Bee", "Addax", "FinWhale", "Burro", "Boubou", "Collie", "AfricanCivet", "Centipede", "GlassFrog", "GermanPinscher", "BigMouthBass", "Bat", "Alligator", "Elkhound", "Albatross", "AmericanCrocodile", "AmericanToad", "Armyworm", "AustralianShelduck", "BerneseMountainDog", "Dorado", "Bobcat", "Borzoi", "Cavy", "Chrysomelid", "Bubblefish", "Cowrie", "EastSiberianLaika", "Donkey", "Dorking", "Cougar", "Dormouse", "Hamster", "Duckling", "ArcticFox", "Gorilla", "Ass", "DwarfRabbit", "Gander", "AmericanIndianHorse", "Dragon", "Coypu", "AsianPiedStarling", "FishingCat", "Flea", "Fulmar", "Dunnart", "Bobolink", "Coyote", "FlyingFox", "Chevrotain", "Galah", "Gelding", "Erne", "FruitBat", "IslandCanary", "Chanticleer", "Curlew", "CarpenterAnt", "GallowayCow", "Blackfish", "AcornWeevil", "AfricanWildDog", "Bluefish", "Acaciarat", "AlaskanKleeKai", "AmericanCreamDraft", "Arthropods", "BlackAndTanCoonhound", "BlueTongueLizard", "Caiman", "FurSeal", "FrillNeckedLizard", "FritillaryButterfly", "AfricanGoldenCat", "DarklingBeetle", "Adder", "Comet", "Dore", "Chamois", "Archaeocete", "ArmedCrab", "Cuckoo", "BushBaby", "Beaver", "Hapuka", "Grub", "Ammonite", "BluefinTuna", "Gannet", "Angwantibo", "AzureWingedMagpie", "Blesbok", "CapeGhostFrog", "Bellfrog", "AbyssinianCat", "Hyracotherium", "AndeanCondor", "BighornSheep", "Ekaltadeta", "Flamingo", "Cock", "Kinglet", "AmericanKestrel", "Arrowana", "Glowworm", "Hamadryad", "IsabellineWheatear", "BangelTiger", "Canary", "BergerPicard", "Anglerfish", "Dowitcher", "Brontosaurus", "Bumblebee", "Carp", "Degus", "Eft", "Foxhound", "Gavial", "Dove", "Degu", "Drever", "Junco", "Dinosaur", "EastEuropeanShepherd", "JohnDory", "GangesDolphin", "AmbushBug", "Anaconda", "BlueBreastedKookaburra", "Babirusa", "Cockroach", "DutchSmoushond", "Aracari", "Equine", "FlyingFish", "Crayfish", "Gazelle", "Grebe", "HornShark", "Lamprey", "GrayFox", "CollardLizard", "Dragonfly", "Huia", "Caudata", "FrigateBird", "HowlerMonkey", "FireBelliedToad", "HorseFly", "Bustard", "Boar", "AfricanBushViper", "Chipmunk", "Graywolf", "AmericanBulldog", "AfricanHornbill", "Chickadee", "Aurochs", "ElephantBeetle", "EnglishPointer", "AstrangiaCoral", "AmethystGemClam", "Armadillo", "BengalTiger", "Astarte", "Buzzard", "Bronco", "HorseshoeBat", "Duck", "IcelandicHorse", "Frog", "BarnSwallow", "FruitFly", "Anchovy", "Grackle", "BallPython", "AndalusianHorse", "FiddlerCrab", "Archerfish", "Bison", "BrownButterfly", "Garpike", "AffenPinscher", "Agama", "AlaskaJingle", "DeerMouse", "AnemoneShrimp", "AfricanHarrierHawk", "Dalmatian", "Hapuku", "ElephantSeal", "Herald", "Grison", "GroundBeetle", "BrahmanCow", "Gonolek", "Dipper", "HarlequinBug", "AmazonParrot", "AmericanPaintHorse", "Bunting", "DassieRat", "IberianEmeraldLizard", "AmericanBadger", "IndianHare", "AlligatorSnappingTurtle", "Bufflehead", "AzureVase", "AssassinBug", "AmberPenshell", "Esok", "GentooPenguin", "Hog", "AfghanHound", "HumpbackWhale", "AngelWingMussel", "JumpingBean", "Conch", "BlueMorphoButterfly", "Hackee", "AyeAye", "AfricanParadiseFlycatcher", "Bellsnake", "Anteater", "Bass", "BlackMamba", "Gull", "GoldenMantledGroundSquirrel", "AsianConstableButterfly", "Chupacabra", "BluebottleJellyfish", "Dog", "GalapagosPenguin", "Fox", "GrayReefShark", "FlyingLemur", "GreenDarnerDragonfly", "Kouprey", "Honeycreeper", "InvisibleRail", "Eeve", "Firefly", "Eagle", "Cicada", "Cheetah", "Bilby", "Crow", "GreatDane", "AmurRatSnake", "IrrawaddyDolphin", "Barasinga", "Hypacrosaurus", "IsabellineShrike", "EasternGlassLizard", "Hoiho", "HairstreakButterfly", "Crab", "Hammerkop", "Acouchi", "Grouper", "Ibis", "Gourami", "Fantail", "AnkoleWatusi", "Anhinga", "IrukandjiJellyfish", "Bagworm", "HerculesBeetle", "BlueShark", "Katydid", "Auk", "EmeraldTreeSkink", "GoldenRetriever", "Blackbuck", "AquaticLeech", "Heron", "AtlasMoth", "ArcticDuck", "Egret", "AzureVaseSponge", "BaleenWhale", "Fly", "Honeyeater", "Dodo", "AndeanCockOfTheRock", "Bullmastiff", "Gnatcatcher", "AtlanticRidleyTurtle", "AdamsStagHornedBeetle", "Backswimmer", "ArkShell", "Chinchilla", "Eland", "GiantSchnauzer", "AdeliePenguin", "Canvasback", "JapaneseBeetle", "AlleyCat", "BuckeyeButterfly", "Bream", "Bug", "Coney", "Joey", "Kingsnake", "Barnacle", "Colt", "EmperorPenguin", "AmazonDolphin", "Copepod", "IndianPangolin", "BushSqueaker", "Gemsbok", "Cockatiel", "IrishTerrier", "HochstettersFrog", "Koodoo", "Kawala", "Cuscus", "Eyas", "Hake", "Kookaburra", "Allosaurus", "Booby", "HarrierHawk", "Chital", "AcornBarnacle", "Catfish", "IridescentShark", "Kid", "AnnasHummingbird", "BorderTerrier", "AmericanAvocet", "AmericanRobin", "BlackLemur", "Cob", "Dugong", "Gerenuk", "Dikkops", "AustralianFurSeal", "Apatosaur", "FreshwaterEel", "Goosefish", "Dogfish", "DogwoodClubGall", "DuckbillCat", "Blackbear", "Gopher", "Grayling", "Kagu", "AustralianSilkyTerrier", "IrishWolfhound", "Fowl", "Diplodocus", "FunnelWeaverSpider", "Iguana", "GreyhoundDog", "Hamadryas", "Groundhog", "Guanaco", "AlabamaMapTurtle", "AntipodesGreenParakeet", "Coati", "Condor", "Annelid", "Fossa", "Bobwhite", "AmericanMarten", "DarwinsFox", "Dromaeosaur", "AsianPorcupine", "HoneyBee", "Laughingthrush", "AmericanSaddlebred", "AmericanRatSnake", "Echidna", "EnglishSetter", "GalapagosSeaLion", "Abalone", "GhostShrimp", "BrahmanBull", "Cutworm", "BelugaWhale", "Buffalo", "IriomoteCat", "JackRabbit", "DesertPupfish", "AmericanLobster", "Icefish", "Dingo", "Banteng", "GreatWhiteShark", "JuliaButterfly", "Doe", "Chafer", "AfricanAugurBuzzard", "Damselfly", "Angelfish", "Anole", "Basenji", "Aoudad", "Bufeo", "BichonFrise", "Boutu", "Dromedary", "AllensBigEaredBat", "Bongo", "IndianRhinoceros", "Bittern", "DutchShepherdDog", "CanadaGoose", "Anemone", "DobermanPinscher", "AmericanShorthair", "Aphid", "ArcticHare", "AlbacoreTuna", "Erin", "BeardedCollie", "Alpaca", "Aruanas", "Annelida", "HornedViper", "IberianLynx", "Housefly", "Gnat", "GermanShorthairedPointer", "BlackRhino", "Hoopoe", "Lacewing", "Caribou", "ArrowCrab", "BassetHound", "Bovine", "AnemoneCrab", "ChineseCrocodileLizard", "AntarcticFurSeal", "Flounder", "Flies");

        $k = array_rand($adj);
        $v = $adj[$k];

        $j = array_rand($ani);
        $w = $ani[$j];

        return "$v$w";
    }

    /**
     * @return bool
     */
    function DBLogin()
    {
        $this->connection = mysqli_connect($this->db_host, $this->username, $this->password);
        if (!$this->connection) {
            return false;
        }
        if (!mysqli_select_db($this->connection, $this->database)) {
            return false;
        }
        if (!mysqli_query($this->connection, "SET NAMES 'UTF8'")) {
            return false;
        }
        return true;
    }

    /**
     * @param $str
     * @return string
     */
    function StripSlashes($str)
    {
        $str = stripslashes($str);
        return $str;
    }

    /**
     * @param $str
     * @param bool $remove_nl
     * @return string|string[]|null
     */
    function Sanitize($str, $remove_nl = true)
    {
        $str = $this->StripSlashes($str);
        if ($remove_nl) {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
            );
            $str = preg_replace($injections, '', $str);
        }
        return $str;
    }

    /**
     * @param $message
     */
    function error($message)
    {
        echo $message;
    }

    /**
     * @param $URL
     * @return bool|void
     */
    function RegisterURL($URL)
    {
        if (!$this->DBLogin()) {
            return false;
        }

        $URL = $this->Sanitize($URL);
        $urlID = $this->generateUrlId();
        $result = mysqli_query($this->connection, "Select * from $this->database where url='$URL'");
        if (mysqli_num_rows($result) > 0) {
            $this->error("Can't run RegisterURL");
            return false;
        } else {
            if (!$this->SaveToDatabase($URL, $urlID)) {
                return false;
            }
        }
        return;
    }

    /**
     * @param $url
     * @param $urlID
     * @return bool
     */
    function SaveToDatabase($url, $urlID)
    {
        if (!$this->InsertIntoDB($url, $urlID)) {
            return false;
        }
        return true;
    }

    /**
     * @param $urlID
     * @return bool
     */
    function getURL($urlID)
    {
        $url = '';
        if (!$this->DBLogin()) {
            return false;
        }
        $result = mysqli_query($this->connection, "Select * from $this->database where id='$urlID'");

        if (!$result || mysqli_num_rows($result) <= 0) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $url = $row['url'];
        }

        header('HTTP/1.1 ' . REDIRECT_RESPONSE_CODE);
        header('Location: ' . $url);
        exit;
    }

    /**
     * @param $err
     */
    function HandleDBError($err)
    {
        $this->error($err . "\r\n mysqlerror:" . mysqli_error($this->connection));
    }

    /**
     * @param $url
     * @param $urlID
     * @return bool|void
     */
    function InsertIntoDB($url, $urlID)
    {
        $insert_query = 'insert into ' . $this->database . '(
		id,
		url
		)
		values
		(
		"' . $urlID . '",
		"' . $url . '"
		)';
        if (!mysqli_query($this->connection, $insert_query))
        {
            $this->HandleDBError("E1");
            return false;
        }
        else
        {
            echo '{"success": true, "url": "http://heck.pw/' . $urlID . '"}';;
        }
        return;

    }
}