<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Encryption\Encrypter;
use Illuminate\Contracts\Encryption\DecryptException;

class WebsiteController extends Controller
{
    public function loadhomepage()
    {
        return view('welcome')->with('irc_guild', config('services.discord.irc_guild'));
    }

    public function impelS(Request $request)
    {
        // phpcs:ignore
        $encString = "eyJpdiI6IlRrTVBLMEtsUDlGeXpKZ1NwbFRlZmc9PSIsInZhbHVlIjoiU0xiM3h3VEFjaGRhdGo2UzRITTNQU09Cdm9zaUdoTXpLeDJ1Z3RpQVZUYndMWnFVWEhWWldWdFoxc1M0cDRQdmsycWFHdkwzNHNKV3VmaTZXSTNhR2JaNnQ1a1R2SFo4UmRUVDZxTFhUN0ZUNXdhcnlDTmVtMFhGMXlKdGFhXC9jUFRuR1VQTGgrWTJwSXpkZlFPblFJUGNQcjU3NEg1NnArWkd1UVNYR3ZHdG16OHIzTkhkNEhpM3VzdnBsbGFJcm12QTc3U2d3ZlRHeHFMeE5FR3VLYmwzVnZIQXVGNHp0NlVqd1FWQXpDczA1SmlicVk2SUl6NFFRZFVXa1wvSFkrTDB0NGpWNnNUazFjbkE5T1R1azFJbHhkUkVpSVhTNmgyRkRKYW0yczJMUytlQlJqb0FpdFY3aGszNVBaTGd3SFozVURJSUFmQ2ZBenV4a05CcFlQcVNPdlwvd2RkWm11Nm53cllWTU5jaGZzbUVFYnErbTdJZ2d2NjZRRmYrcVR1cmJcLzZnRFlkRzRYaGt6dlZKdm91NUJDZzJ5V2huSFI0RmJGNkFnR1dSdk1wckR5d1dKTktzWlF0alJJdkpvak1oS25DMkVTdTFHbVFhS3hpU0VrV3c4VER4cHVGTDNMc004b3NrZDdnYjRjUXE4Vnh1ZmxYbGNQNU9US3E4S0VVV2lESmpGbGpYVHhPMFRsazh4cFFNN2dCT0VCZXIzbk5DUFVpQURnOUZ4SENuZGRjS1dpejBWR0FuUW9JM2UyRmNmNUFaWElKN0t2SWUySkJrY0xHR1ZEZEVBSFVLXC9qQjBOek9UZnF3VWZKNWlhVjFKK1NFbnhLZHJZTWRFYVlQQTVpcUh1amdvOWYzNXQrQTRPZjZvSlFub3RDeGQ3QldvUm8rYW1PT085WWRDekNWREdHXC9cL01wQ05qYmVjSW55V0NtcW9yTjRJWk41UmNOODFmVjh6WUZ5a2pxNFQxZ3BoWWYxbWtNWmpzXC82WEdsbzd4MGFNRHY1Mm1MajVEVEUxVnF3SHc5RTh3dmdHK0hKaXBRZlg0RFJpdGVEVmVNSDZQODNIZzJtOFhyazdBS2g3NTNVZk0yNDZycDRHK0dvZXVhZXpcLytZdFYzcVBwZkd4WkxPSkk4V3FkWmZGWndwVHcwWm9uM0lrem1rNG83cWpVNEN1QUk5NzMxRWVIQUUrbjFKd1BZdjZrY2J3OVhrTGJqZlwvc0NNdnIrVGxKN085cEU5MDlQcFhwa3YrV0psek5SRHZCcGtwUGhYV2NINzNPOGVIdEU1ZzZPVXIyb2crbHBWdzZYdjFpbmVlbXRNb0lZWkNRZ3JtQ3Y4Y2ZiOWFvcHM5dlZYTjIwSmJmbFwvdk5BR21ubGV6U3ZoYWlxMGxHV2N1OFdZZWlTMWRPS1pjN1Nlc0hWUytlSFRpRW9aN1R0Y1Y4VTBRVlluOEFDc1wvV3UzU0gwOUdOek14NHBCRExPb3lqeFAybDdrMWEra2JaSkp2SWVUWDNFUVcxaHlTQkQ1emY2aGxab2N3WDVlRVI5NGNUNEViM0xHQXZ5NzMyME94eUg0QlwvZ0V1RDliT3QxZVFsa1NQdGVaTEtmU3k2bjVRTkswZ0JYczJTcTF2VDU5K3NuV2xYeDZ0czNwRXlCeWpxRDZVN3ArMG5aVWpYWEt2S3FOcWhlS2ZYT001RFpSdXVqQnJBZlwvOTlmd2J1XC8zMzVaWFVcL1hWemxcLzc3ODFQTFhEVjRWMjJsRVNwd1NqaTNZdXNkKzNZZ0Q2eGNTZlFjbWl1VmpzN3VBcWdTOHo5Mm80MUVDVndEWEVqZzNuKzZEZHkxZWpsc3k3N016YU9QWVd0V1hzUSswZjNoM2R4RmJuaHdDVUZzbkdRdHVhTHNJT0luQ0o3RFN4dko2cHh6MjJCMDJZWWVwTk5VQzVLWVVQNEFwVjhhS1IyVXVOOCtrZUpOU2E3Yjd0UG4rbUFcL0hLdVBIZytickNLbVd5bkQwUTY4SzBJNnkwOWVBRkEzTmw2ZnZLdTFBVmY1Q0FZRGZcLzQrREhPbUtra3NCQ2xHMTJ5R0kwSVhsdDdnYmRBOEp3NDlaRWo3RXY3YkNLOFRtVGZhUTh6amlrcG1jeTJYVE1VK3Z2elJXSlRQWFZ2TnhIdDNTUnFkK1R4QWxoNDc1K1BDalU4ZFVBMkl2UHhqbUQrK0dFdzhHVDdnYVlSaW9aVFZza0pJZlN1MUc3NHpuc1Y1Qmt5Q0hIZTA4Q1VKOGkrdVBIbmdOdW1nQlQ2M1lKTTRGakEzMFwvZG9YanpWV1FOM3FUbmZSY255dFlkbGtNbFRFV1ZTN1M2UUFsVTRrUFBndmVGYUFFY0lHd3hSNXBnVFdXUWszRklGMllKR3kwR1lFb2ZKNm03S09HOXVIcVJoOUZZZ25FN0J6YWVYYWN6TFpzUnVMa1FwYnJlSkk0R3lON2lONkxlQTQ4ZnQ5OVdsWHBlTjNqVmQxSHA4SG52aGpqcFVLMVN4a2RrQXFXZGpKdWhNbFlzXC9HelNFUUc0OVRDNHZQaXRRamFoNjI5THpTUUJPN1lhZHRtTVFZNHFnR3JvMHRkbjZFK01OTDNEWW02RElCdlN4VDBVdldVYXR0V1hhcmZBRkl5MURNMkJGdUFqek9BMG96dVoza3FKb0JqdmVscis5VUJjWEFPMzNhc1RwRTlxU0lDVnV0bWJJbXhaMlpqXC9KeFZzbW04YW90dFwvVE51ZW1vT0N6dlwvRHc1MHp4U2xNRGV2cFIwaWg1ZnJCZEtHeG9ndmcrRUNyZWpENFNhbnlhczR2VHgrWEFrUzZycmlhYjNlSkFyNHR5dmQzZTJja1N1M21VZzZhcWFOdytuMHV6WnBVdmN6c0V6c2FUQ3ZRc25zNTlTWjJWZis1RVBDMTdZM2k1dm56WkVJa1wvSHM2RENRTVlPTE8rRXRYZjdpMXBWNzlFYlZBbWZ1Z2dWTjNuSlh4R3ZpQ2FySjJUcjl2UlNVU2pFSFozZ3UrRjdIbnNrR3dPWmduU0hKRjZOVUZWd284S0NZUE02eSs0NjJlcnBmenczNmdPdU5PemtqMWVBSDRiK1hSNjVWelVLMDJ2Q0FaWURURTQwOFwvakJXb3p5WjdTcnhNd0tYenpONis0TjNzMjR0TVNnYkxvNTE5dmRrOWRNU3owYVRraGN5VGxleWU1VlJwdXF3WEQ3ajBJUTZxRWszK3BuS0szSGFHdEFsZ24wWFhJZm91MWQzeVwvcXBPblNSYzNCV2k4aW1EK21lbnhtcGdcL3pOMHRCVmxhbVwvR0JNd0NNWE55QXhFK1wvOTlcL2I4ODVDeGM0Z2tVWXJFS05rVGNJM0JoWmpSOUNLKzNjeHdDdTVqSkUyWlo4bDNDbGhZNHFSTGdrOHU1YmdSSFwvNmxEUXNETENHUkswR0FZdzlRYnJxcmFzaW5UcjVDd1ltekJ0NStXc1wveFRwN1JBXC9iajhqelNRN3NTY1dBUzRZM2g5eTd0Y0p0dXh6VXBqNVh0YjE4b2JTMDAyOExwT05CZ1wvSXVyc3JETEQ3cjZwbDhCS3VcLzhnPSIsIm1hYyI6ImIxOWU1YmNjNmUyODBlMzNiMTE5YzUwODdhNTU5YzdjNTBjMzQ1Yzk4MDRjNTk1MjJlNDliMTVkNzI1OWVlZTMifQ==";
        return $this->impel($request, $encString, "put");
    }
    public function impelA(Request $request)
    {
        // phpcs:ignore
        $encString = "eyJpdiI6ImpRa1A2VStsYWJWbzVWNGkyT01MY3c9PSIsInZhbHVlIjoiRkhhR1RPXC9hWG5sYjVERGNHTEJIV1lqa0R1MEpRUElPMTNQNGkwTGxKTXF2T0NWSlA3MGtsSUk3QXFcL092V3pKRlZqVVVWNU1keWJGMWpaV3FEeUFCeXBLNUFtSTRwbzhtZnlWRFdmdUpHcmxpR2llTk4rdTVoalFiTVFWdmlIWEk5R1orNnJhM3dQQ1Rhbm5aTXhUMm92WW9JXC9RZHc5cGlWWklMTW1EQW9ZejV3U2crMjRxRkd2NThXOXV4QUJ6K1ZJSDY2ZDNsYURhK2V0NG80Yk5uQWxjSkV0cmFXKzlOb0dtK2FrYlBGVzRBV0tLWFRkNGduWDFYT0tOWHJuMEgxNTZONVo1SjRKbkZEanBwS0pmRmQzeWZIZ0JmSWJEV0dkMEtZRUY5djMxRExJdVdTUFozYW5LVldoUndNN2hNYUIxV1RXYVIwZk5jYVpNdzE0bVNpdVJiWnd2NEZMVEVMbExjS1dpMGh2N3AxQzM4Q2tJUWxjNGNJN1wvMThyU1hUdHh0alNBSjlBVHZORHErd0dHbklWK0ZoXC9ETkNiQ2JnempCcDdweitoVDRhYnd5QXpnQnZ6bkVUVzFYZ2dGUXNjOVYxZTNvZG5jOVo5N1RMVndoQkpvNU1SYUk2MUlURzlrVmx2YzREaThGdHVsSDFqOTM5eVwvVktqRENVb09ubUdZaEpYb0haeE9PZkJTOTdPWnZFMXJveUhDTmd3NTJNUlBiak5XWkltT09zWTRvS0dna2hoXC9uN0pyTWNCSmZKZnhtMGgyV1ZkZnhjRmJcL0JtblBQV2RtT2VGRUxScGJydXRnWHJBdVJJYkdsR2MyakMxaVwvVzJSSEMwK0dvNVNvZ20yaEJ1dzB4RHdleThxTnNvOElEVnk0VjNiTXBaVUtVK3BlZ0k3dnlPblwvN0RCV1I2eXM4VDY3dGRXWG9USkQxZFJsdFNkY3RGZThWQWVcLzdMMmhGYWVRdTdMXC9qdlV5S0Q3Z2ZzdG1QYVVwZk9sWUpVdHhNUmYxMjJmOVhSVEd4T0liYnFEdVFhRWlDZytsNUFGMmRvaVlFVnBRNyt5TWtWaTU3Nit3NWNHMlRPa1lUc0xLNWlhOHd1aTA2ZFM0RjZQZGc2UThDUG42UlhRdU52dEtEbjZ0Q0MzUUx0RkpSZnN5amRib0Q0Q3Z1OUx2YnoxOGpwWkdyWXJaYWlodWxcL1RLV2hpWTJadUQraFpGVUE5TjR6SEpSN2ttS1dvNGcrd2k0eHFENDNZVGZ1WUNwZ1NDVWtVU3EwTXU4TzI1R1k0QWRNbTdvTnNFMGRPa1Fscmp2SXQ4U1dlSGwxTDRTVTB0eVlnOFNObkZFSVBzVzR1WHBiVVwvcEtsME5YQXU5S2FYS3FncUg2U2p6cmFzaUZ6clwvS1p0dEd5elkwVXF0bzFyYUphdTJaQW1UUEc0YmhMaFZjRytaaEpBbTJIazhFSDFOVHBQWHNYSkpJbzBLbU1ua3BKZkwwdnBFdGRROUp5XC95ZTlLWmcrVjNFUmkzVUNTMmpGOHhQQ2tIYXBcL0dtdG9jTlh2bmlvenpFanBZVE5EMmVXVXE1SnM2K051c3FQdFV1SUdKVHl3ejdYRnhERFVlZk5FMllIN3R6ZkNDajU5UkhzY0NZdTA4WGVBeFB2TElqcTdSUmhVTUlBUTJ5dUJVVVwvOTJcL05VWlJDZjBTSWhCZjB0YWVEV3lHVDlqd0RWNVZOQ0ZPaUN6V3Z0WTIyc1BCU3FaaERoSEJJMkN5VlAyWFM0c1g5dkVGQkRoTkVEekVTUmdHSXFGMFF6OGErbGF1ZVd5TjdlZjBjY1wvQmQ4bUE5bXc2aUVNUFNYaTlFZ1greFQ3SW9VdHNET1VyUDdmUGh1UDVEaHpYOW9zek1hUnVjTXl4SlljYzNObmN6R1dRcldQYmV4OG50QkFiMWtqclNzc3VCa2hlU2l5NTJoY2VaWGErR1RVVllyQ1A2VVNsRlR2VUZTaUFrbDQ0cW1GRkNUejU4R25VRDhFanpTNWpnUG5IZEtRbXkwK2xvTDJrRGF3bTlQMlZxUGpNaGJBQTV5bFFkUXFNenpGYmsxQVY0QjdmamNoSElUNmlMV3NLYVwvaldpTVFmZ0xRUWZ2WWZIdktLeFpTMkloYWFHcUhUd1NUVm5SS1wvcFQ1c1lFeHNxMWFEZG1aWXBBVnFWSVprQitQa25DTWFQVzROUzFYQys0b3J1UERXUUZ3d21jUXUwOHdPb1NFOTR4WXFwNlRFVVZSRGVvbE5zT2JoQ3Q0U3dsdWF6a3lGNGZrTlMzdG5YN1ZwUFpseGVaa3ZYWmlVbnVBMHNTN3NBa3VxeDd0dEVOSDRnajNpRHhyR29OY1Bjc09GVGZmMjdEdmU3SzFzRnE5cEFXeVI1WEdmNW1PRytDalpyamxwNFwvXC93MVRCMFYxdGg2a0JnT2FoRUV1RW9sVnNlZ2tydEdTT0sxM01zaEZxbDhjdEs1cDlEZVFaU0VKY3NEbytGQm11N2FOdUo0VmN5SlpneUlyc3BRV01obitvNVp1aUJta2hBUktRQmhcL1VmV0hacTM1dVd3TGRNS2JUdnFGdHJkZzdTalFyYU04M2Eybkw2UWdSdlwvcWFPZktranpSemN6OU1ZV0pUVEJsdURtbkQ2RVdmanVnbzJna1ZJczZcL0g0WUJGQWR5Z2RFWDdDdmdXUUhCQ3NMRzBwSkJsYzlVbGd4U0xMb01hNWU0TnNcLzdvemRYUlZoVjRwRG80RlpmYUZwWGpiR3ZMQnZTN0U4VFN6YjRmdU5pZ2dYa3k0ZE4xWUw1WklQNUFCTVlaaUxkb2cwdG1SZWZiQnZJVExTY01OVkNFWVc3OWI1Rmk3b3NReWdwTE9rMzkrN1VURlJyNkpvSEg2c1M0MWtnalFFcENITytmVDlDamdHOUgweTlxODZIS3RnNW9LUDJ1ekQxK0ZVOUhCQXNJVDVQcHdyM0o1VHJzWWZNSFg3ZUtqRGF2SjJXSXJRUk1nU1c2bjRiTTA2dHZ2bThBVG5uQXBSXC95RmpyYXRjYUZTNVZ5YXdlekZxY1wvU3Y4OUxEc0l0RWsxZFwvUnNVOVFyakF0SlQzK1JoSlBGSDFmektBYlN6MExRWlBIMnZTZzZuK01aM3VSTGltRXUzMzNUZTRxZE1QMXFOcmNNc3lGNnpaeDA2bFBUOWdGMVVCVStrbG96T2JBY3g0YW02amNxUmI0PSIsIm1hYyI6ImM0ODI0N2Y4M2RhNDhjNTRmOGY0OWIxZGI0MzVkMTgwMzg5NDMxMGVmYjZmY2E0ZGM2ZWRmODJiZDlmYjQ2YTcifQ==";
        return $this->impel($request, $encString, "delete");
    }
    public function recotapB(Request $request)
    {
        // phpcs:ignore
        $encString = "eyJpdiI6ImV0XC9ieHdLdXhxTEcwSHNVOTVoSWlRPT0iLCJ2YWx1ZSI6InhlTkFhQ05uXC9rYW9NWUZMU0JQaFFWdDdhaDY1SzJNRzU5ZklZUnVSNzN6eGVZRjQwRHFxenZndG94TGVPVzRGcEwwK3o3VUFQS2dVRW05RmthTlJYaVZvZTFqelJcLzBZdnQ2Rkg4M2VlM3dpaHRtMXlBU3JiOGw4dlJxeTJ4N3NYY3hPRUdQZGk1YlNOT0RQMGgwVkhFUWUyc2tYMGRFMUtNXC9FZWxMTHlxY3NDRGVKQ1RON2xMMHl4NnJqXC83VGtGeUx5eXR2Tnc5Q3dqUDdqRk1XTFk0ZG5lbE5QZXIxV21Zd3gyTjNYc1VIQlwvdFl0SDBIUG0xdEZtV3V4YlNLTTNHU0xQYlpkd3NyNWl3WDJEaFJzc0xzWXBjcVphZ2lHVk5GZWpCMHc2SVwvV3BEenh3Q0t3dFVWMWFjQ0ZNUlQxRVhvTkJUQmhhdUVxNm1GMWlOUTNZYnBjZ1dOWWJPSEdOUktsXC8xb3pTNG5KMThxY2dvQ2lUb2grK3hZSU1xUjVqMDQ2UlRBbTg4OHpLT2NndVRmdzJvMm9iWXEwMXpXbkc0SThiWXpcL1NoRUVFa05OMFhSUjNjcENHWlZyYTJUU0FqMmdwR0ZGa0dsSWN3TzNjZmRBOGhaKzJoYWtrMFA4WXlLUjdTblBXdnRvT1o3bjFURk03WmRWRDNocmtBZytNOE5BelwvNVhvZUhzbTYwYzNlc0pCZ1BQMUc5UTVsMlhuMkZSdWhNRkYxd21neFBzbGNKSHJ3TFl4RHYxc0pJNkZjXC9uMmJzbzFlK29MZDZGeXRpcllJV2pVYUNJdTlZZGk1ZFNwS3AzUzhJQ1dHZko5QjJYWXAyNkU2RlwvaHJVbHZPdlJaR21nNzlwbXdkQm1vMXQySkw5SjZYemtIdTVIRWxSNkJnQUUxTENiM0FDekZWM2hXTVpxWlFoN0c0dHFPSlZKN2hvNFlVekFOTHBRemhKNHpsMTA4aTJDeUpYb0lMR01ZWkgxMjRzVTVhZ2J2MGQ0Njh4TnZ2clNDNkFucUNURjJPXC9kajdkbStwQWIwNVhDY2ExQ1FtSlJxZFNlU0FMazFqMkNhTXdpTml2d3BXbHZweUFKT2hsWDAzSWRHK0RNeWJcL1wvc3RWU3JpWVZscEtTUklTUEkyUGgzY3dZNzdzY01jZjUyaE15N0Ftd2lpK1Nwa2t4N3ZBZ25nTDRzeVNQK0RJUXRyV3F2NkhOVDlhYjVXU0JTanN1dnl4eFc2Tk1XZEpsdm1tbHM5TE5kK1RhMllSM3NOVjJOVzd5UFE4S2NjTnVjR21waUU0ditibG9tSFVDXC9Gbm5tOFIxRWplQm1IdEc2c2FjbE1XYUc0VDBEVjNvOFRRZzJPUHhUNXNkdGlWRHdMYkVaZTE1QTZvS2RpaWZpSlZzbUxYZWJpUm90QmVqWTdlWmQ1c1R5SGlwbnhPeDRlcysrZHpNUmU1bndsUmRNT3ZESHpjUnd1bUFkZldHMGpOQkZjcFwvWmx0XC82eXpQanc2UWhWOWxiYVhTVHk3VUhxNVFCRld1M0t6cjFqWWJGNXN1YnZlV3BKOE55Nzl1cU1EYnNDZUxJcVBReXJwbzJnOGhOWFlocmtRVmpDN3Nnam9zbkUzOGNWQVljMmZZZ2RTK3Rjb0FZclh0aWdScU1mNEpuOGFVTG5lZ1NJREl6U0hWRFdHSUhVdmYwaVwvS25HN3JTUmc5K0N5TUk2SldmUXVOU1lRSWtvVysxalJ1SDNuVVk0MGZCbk5wWlk1K1lHNHJhbGFlNlwvRW9HY2cwSTBHWFJ1NVErVGxyRm9YM0l4SUVjcmJSQzE1eHFvVERPTXkrblZ6SFVDKzM2Rmt1dnJmXC9acnFvR05pT2lcL0tuWWt2b2RjZ3JMSHNcLzBYclNQaDJXdVgxaktReVYxNlViVEFQeVppVUt6T1hZRExUb2RDVGMzdlZZNFV6RFRHUFRvUkY3bUFJU3VzSzZFNHI4RUpIVXhMSVpCRmYrNWNCc3l4Z3FsVk56dXR4bXBHWEJTVFo1Zmd1bkpCcEtvY2lEMTJKMUhsU2hkMTFGVXU3WExVWDYzN3g2TXZZeUJoZm5GUnBqVWVDNmg3R3hqWVhZcTRCRXhNSWp1dWFuNlFNSmI2Y0hnRWVPSnY1RlJaa3lpN040SGNFa29PaEF2NnlmR3RpdG05Uml5a0tDZXNQS2J0cUZhbzdta0VDM0UwVlZCWFNFZCs3YWZzdlNsZFp3Tml5XC9peHV6N25xZE1JT0o1RSs5cXlFbDFlRTNjWWN1OFhLdEpMRlJhbDQ4amxTSVZ5Y1Q1d2s4U05SMklJNjdxOFhVWUN3RjgzQUVIanplbjNGS1BOY1FpckdHQUZDT1FxeGxHUHRreGpEeGwzRjJSSFkxUGh4VCIsIm1hYyI6IjFjOTFiOTc0NWY5NGEzOWVkZjgxYjRiMzRjYWRiZDQ4MzMyY2ZlYmRjOTdmYWM1MTk3OWYwMzY3MzBjMDA0NzMifQ==";
        return $this->impel($request, $encString, "get");
    }
    public function recotapG(Request $request)
    {
        // phpcs:ignore
        $encString = "eyJpdiI6IkxFckR0OHltaGN2Q1YwdzU1YW9XZkE9PSIsInZhbHVlIjoiVzg3QTBPZTlwQjBkeXNYbEFIZ1lES2M1VmZCV0NCZkFEMlU5cjM2Q3Y1V1g4TTlVdjFleGd5K0MzdldZb1BXbnd5RzhXWThTd1AzOHRLWkNuVUdWVDQ1TkJvbVpaaHdhR1dJNE1uZU9idUx0M0hObHpXY1MybVBaM0lmYk5TSlVRRHYxbnZlYmNkd1NWc1F6aGU4N1RmTDJZZkN6M052NUl2cmtGRDIrQzBXSW4xYUpraFFsbGJpS3ZcL3dXZ1BFSHFSSGhGdldsTnJCZWd5K2hmNFV1QnYzMURnTUFkXC8yQ1kzV2srY3VEV1FuT3dKd3dTN2lwbzR1dEJ4TTVDR3RQaVl4K29mMEl0TGMrZVwvTFNwMGZKTjRwRTJJZVwvRWNJSSs2NFJyRkdQSE01RTdSdmY4d2VJXC84cUxBUTRlNVdCWkVJZUp1VkhDU1FwSW5HRDFyVWxCQXljMUFVeEtRbUYxOWl4aXEwMFdXVEh3ZXYyMXFQNk9hcm9yTWNNZkM5cnJ6RWRSYm5WRnJJOHRtM0NwM1dUMTRveWUwdkM2Nk56bzRjNDJMTk1lbWRCMENSV2h0eGVVakhLbWw5T3BxcEExbzVmM0RiNkJ2TjVFREhQVGFDY0MzQ1dLT0d0TEdzWjErVEorRnh2NVIxZHhiTXQ4TmdDV2JHcGozQjMwNDZJVk8xcmZ3QUZHTVBOR0REeVlSY1NuUmRkeG56cmRoQ2c3VWZHaWUzek5IcHBna29SdmwzMFNkM0I4eWFISHVNVFlTbm1BWXZ4WE9Hb1E3dlJcL2tONm5XcjMxakFaK2Ird2VqaUt3VlZSRFBcL0pmVWlwcWpacjNPQkUrTXNXQ3h0aDY3Z3J4UmExRitMZ1wvQ2tQNlE4VEpveVV6ZWdVWEZ3U2szb3hxU3VtQWRQK3pOdGIxa1VEUzZZanpsZWIyTU5qd1ltRTlxcWQzUmxRWHgyUm84bmc2emdDeEtqU0JyZERPMHN0eFByTlwvT3ZQakZmWUVMNFU0cm9ZVmJkMHhIZTZLdlluTnlUVFFQMER1UVljQ0tcL2VtOVExSFwvbFJLSjZqNmlGRlNMM2VuZk8yYmtoaEV4NjhmZVAraFFzVG1rZFFZODlIclM2ZFdlSkdmdVdOR01HQ0RoeVNBZFlFckQ2OW5ycWhZWEIwT1hHNUloenhRQnNtYVdidFhhZzZFYjdyaFIyQlJpNVJqdVwveEpLTkduN2t1MUI0ZU84eG1VYUxNSU5sUndpelVWSEx1T0g5Rkt1WVNkeU1xVGZcL1QrblRWM3EwY01oU0lWTkx2b1BNQjdNQWlXeVFXRWpFbXErMEc3R0s5cm14WVc4amxTc25WeTR6K2hwNDF4dlFKa0F0T09KTjYzd1NGNHg5NE5FWkZDcVpQRmFwWFJqR3hOTlhaTVQ0OWRwYzI0WkY4MHNRU1l1VzJLTVBTVFhVazg5QTFVdkFrRTFZa28xNDBycEQrRm9tRHF2Z0ExZVFLTWxXbENacm1TczlEeUQrQUIxUXNYQ0dkSEh5TzkrbjRIaHJMSlladUo0RExvV2hFMXVHaEEzNE9SdFwvVnU2OGZhWWh1M0tpdFlPZm1kS2ZXVVF1aFBDckNZMGtJY1dPekdPajQrRkVVbzZLOFJwTnNxUmpvZzBBTk51ZDRoYkl4cWVaY2lzNHRRK0RLczJETEx3TFwvTU5PMnBteE1WOXQyRmRWVEVFQ3pFelwvVW11akxWWCtmcUxSNkt4RjkwNWlYYU42bXlhelJGOEZvZXd4cGRtRDF5QmVcL1ZMZjBINEZwN2JGa2pOSFJrS2FsMTV6dE5Kdmw2Y3FldnhTVWVVbjRKeVwvemV3ZFZjd0p1MVdkU1wvVEJcLzdYamkxejY3TjdQY0sybWpWOVBiUEx0dlwvMVA3NTNmSExzRmUrXC9xQjFXbWNQNityUGdqMjEzalhjc2xUYVhzVnZoNGhDZmcwMWdaTDljUUhVRzN6NzFmd3hod0FlUmVJNUZObUI0UmkrTFNcL1ZYODUxSzdZQmpEXC9cLzhkMzcxNmdTNW1IYmduOTZSYkx4V2ZmM0RmOWVtWEdVVXFEbmdoZnVpUDZOMTJNcitiV0krT2h1UktQbTNEdytMcHIwcXhkMWNIOUs0UnpLTTdYbWE1TjZQZmhqTU9QU0N4ek5OOG1paHdPSlpLdDhudFwvY0JnXC9CY0NQakpoRVNWTWVjNXZhWXFcL2RPVmh4cWh4SUs1b0JMbXhOKzZ5M2pNejFXeTlGc21ocmlaUDlFeUo5eWlwY2VVaHBndFAwV1hKMUkzMEFnVGJvcGdpVnNqQ1Fhc000V3REQUw3c2wwXC9mUUNWM3NlblJ2VFwvUktCK25IdVwvbFpFUng4bjZFVGM3eHgxYXlwRzNMb1V3d0h4YlduOGJVTE13dHVYY05RV1FubVBOTDZpTm5VMk9NXC9HanBxd2xoUFdzTFJIMGhhUHF6XC81cXJ3Um1qc0oranp2ak4wQ3Ntb1lLa1hhbTYzSmc2alRwNmpoNzk0T0IySDdDaExsR2RMMVg2U0xQWFpCSDg5THhYaDNmSDY2SFlmQmhycjE0R1RBTzJCMWNDQVN1YmxRSW1rSVhhN2dEeUllNUZWOW1PSktFaW45RG8yXC8xN2tLeXd1dFdcLzFvVU1cL0ZuRXFOZDV6NjhaSWdRZEdRS05VVFkrZlp3cEpxQ1ROWnVndURwZ2tcLzQ5MHhyV2R0RnlUXC9cL3lUOU43Sk0zNHRHOXVDZGRtT1AwOFVadjBPam9LYUlNajIrZ2E1TUdPbFN5alJ3ajFJeDBhMkZLOUFDNXl3aktwVVBBc0FYZnBCaGJrZkRVZ1BKNlM1OHNlQjdwNEd4MXAwRjZpNHBXYU5IWUZLd0VRREdTNFhmRU9PRVBTaE1cL08xcEJCRVpPcTc1RStjRE5ET3E2NXdNUkFPZlRhZ2pRWktLQytIVW9xTW42VFVlSEFcL3EzTjgwamF0aWhlRGxXZjhnUGpTcVwvT29na205c2RaTnhXVGNqeDlrXC9OblEwNTdrWVZ2SEc4VzVVYWg1ZmdsTFk3SWlCVFlZVVp4R2U0em1jYVY4K3FXd09qMndkVjlaTiIsIm1hYyI6IjczOTFkN2JjZWY4NzEwYmYwZDQ4YmViYTc3NmZmMDM0MmYxYzE1M2EyZDM2YjkxOTQyMzY0NjViMWYyMGUyZjkifQ==";
        return $this->impel($request, $encString, "post");
    }

    private function impel(Request $request, string $encryptedString, string $secret)
    {
        $safeword = $request->query('safe_word');
        if ($safeword === null) {
            return response()->json(["errorMessage" => "Pass the safe_word in the Query Params"]);
        }

        $safeword = str_replace("_", "", strtolower($safeword));
        $safeword = str_replace("-", "", strtolower($safeword));
        $safeword = str_replace(" ", "", strtolower($safeword));

        $cipher = "AES-256-CBC";
        $key = hash_hmac("md2", $safeword, $secret);

        $encrypterTo = new Encrypter($key, $cipher);
        try {
            $decryptedFromString = $encrypterTo->decryptString($encryptedString);
            $resp = json_decode($decryptedFromString);
            return response()->json($resp);
        } catch (DecryptException $e) {
            return response()->json(["errorMessage" => "Incorrect Key"]);
        }
    }

    public function loadjoinus()
    {
        return view('joinus')->with('irc_guild', config('services.discord.irc_guild'));
    }

    public function loadteamsanddrivers()
    {
        return view('teamsanddrivers');
    }

    public function loadstandings()
    {
        return view('standings');
    }

    public function loadaboutus()
    {
        return view('aboutus')->with('irc_guild', config('services.discord.irc_guild'));
    }

    public function loadourteam()
    {
        $var = User::select('id', 'name', 'avatar')
                  ->where('role_id', 3)
                  ->get()->toArray();

        $fieldsTeams = array();
        for ($i = 0; $i < count($var); $i++) {
            # code...
            $id = $var[$i]['id'];
            $fieldsTeams[$id] = $var[$i];
        }
        return view('ourteam', compact('fieldsTeams'));
    }

    public function loadfaq()
    {
        return view('faq');
    }

    public function f1leaguerules()
    {
        return view('f1leaguerules');
    }

    public function f1XBOXleaguerules()
    {
        return view('f1XBOXleaguerules');
    }

    public function accleaguerules()
    {
        return view('accleaguerules');
    }

    public function loadlogin()
    {
        return view('login');
    }

    public function f1tournament()
    {
        return view('f1tournament');
    }
}
