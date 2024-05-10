<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\Posto;
use App\Models\Suco;
use App\Models\Aldeia;
use App\Models\CommActivityAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;

class GetSelectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function getMunicipio(Request $request){
        $search     = $request->q;
        $limit      = $request->page_limit;
        $page       = $request->page;

        $municipio = Municipio::select('*');
        
        if($search != null){
            $municipio = $municipio->where(function($query) use ($search){
                $query->where('municipio','ilike','%'.$search.'%');
            });
        }

        $municipio = $municipio->skip($page)->take($limit)->get();
        $data = ["total_count"   => 0];

        if($municipio){
            foreach($municipio as $p){
                $data['items'][] = [
                    'id' => $p->id,
                    'text' => $p->municipio
                ];
            }
            $data['total_count'] = $municipio->count();
        }
        return response()->json($data, 200);
    }
    
     public function getPosto(Request $request){
        $municipio  = $request->municipio_id;
        $search     = $request->q;
        $limit      = $request->page_limit;
        $page       = $request->page;

        $posto = Posto::select('*');
        
        if($municipio != null){
            $posto = $posto->where(function($query) use ($municipio){
                $query->where('municipio_id',$municipio);
            });
        }
        if($search != null){
            $posto = $posto->where(function($query) use ($search){
                $query->where('posto','ilike','%'.$search.'%');
            });
        }

        $posto = $posto->skip($page)->take($limit)->get();
        $data = ["total_count"   => 0];

        if($posto){
            foreach($posto as $p){
                $data['items'][] = [
                    'id' => $p->id,
                    'text' => $p->posto
                ];
            }
            $data['total_count'] = $posto->count();
        }
        return response()->json($data, 200);
    }
    
     public function getSuco(Request $request){
        $posto     = $request->posto_id;
        $search     = $request->q;
        $limit      = $request->page_limit;
        $page       = $request->page;

        $suco = Suco::select('*');
        
        if($posto != null){
            $suco = $suco->where(function($query) use ($posto){
                $query->where('posto_id',$posto);
            });
        }
        if($search != null){
            $suco = $suco->where(function($query) use ($search){
                $query->where('suco','ilike','%'.$search.'%');
            });
        }

        $suco = $suco->skip($page)->take($limit)->get();
        $data = ["total_count"   => 0];

        if($suco){
            foreach($suco as $p){
                $data['items'][] = [
                    'id' => $p->id,
                    'text' => $p->suco
                ];
            }
            $data['total_count'] = $suco->count();
        }
        return response()->json($data, 200);
    }

    public function getAldeia(Request $request){
        $suco     = $request->suco_id;
        $search     = $request->q;
        $limit      = $request->page_limit;
        $page       = $request->page;

        $aldeia = Aldeia::select('*');
        
        if($suco != null){
            $aldeia = $aldeia->where(function($query) use ($suco){
                $query->where('suco_id',$suco);
            });
        }

        if($search != null){
            $aldeia = $aldeia->where(function($query) use ($search){
                $query->where('aldeia','ilike','%'.$search.'%');
            });
        }

        $aldeia = $aldeia->skip($page)->take($limit)->get();
        $data = ["total_count"   => 0];

        if($aldeia){
            foreach($aldeia as $p){
                $data['items'][] = [
                    'id' => $p->id,
                    'text' => $p->aldeia
                ];
            }
            $data['total_count'] = $aldeia->count();
        }
        return response()->json($data, 200);
    }
    
}
