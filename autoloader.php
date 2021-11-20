<?php

    function createNameSpaceCollection(){

        $nameSpaceCollection = new nameSpaceCollection();
        $nameSpaceCollection->addTo(dirname( __FILE__));
        $nameSpaceCollection->createNameSpaceCollection();
        return $nameSpaceCollection;
    }


    class nameSpaceCollection{

        public $namespaceArray = [

            'fileNamePath' => [

            ],
            "namespace" => [

            ],
            

        ];

        private $ignoreList = [
            '.git',
            '.htaccess',
            'assets',
            'node_modules',
            'package-lock.json',
            'autoloader.php',
            'index.php',
            '.',
            '..'
        ];

       public function nameSpaceCollection(){

            return $this;

        }

        public function addTo( $path ){

            if( is_file( $path ) ){

                if(!array_search($path, $this->namespaceArray['fileNamePath'], true)){
                    array_push( $this->namespaceArray['fileNamePath'], $path );
                }

            } else if( is_dir( $path ) ) {
                $this->findSubDir( $path );
            }

        }

        public function findSubDir( $path ){


            if( is_dir( $path ) ){

                if( $dr = opendir( $path ) ){

                    foreach(scandir( $path ) as $idx => $p ){

                        if( !in_array( $p, $this->ignoreList ) ){
                            
                            $this->findSubDir( $path.'\\'.$p );
                        }

                    }

                    closedir($dr);

                }


            } else if( is_file( $path ) ) {

                $this->addTo($path);

            }

        }

        public function createNameSpaceCollection(){

            foreach( $this->namespaceArray['fileNamePath'] as $key => $value ){

                if($value != ''){
                    include_once($value);
                    $value = explode( '\\', $value );
                    $value = substr( $value[ count($value)-1 ], 0, count($value[ count($value)-1 ])-5);
                    $this->namespaceArray['namespace'][$value] = str_replace( '.', '\\', $value );    
                }
            }

        } 

    }

    