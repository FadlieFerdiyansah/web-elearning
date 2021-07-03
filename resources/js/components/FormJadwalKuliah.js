// import axios from 'axios';
import axios from 'axios';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';

function FormJadwalKuliah(props) {
    const [kelas, setKelas] = useState([])
    const [dosens, setDosens] = useState([])
    const [matkuls, setMakuls] = useState([])
    const [kelasId, setKelasId] = useState('')



    const store = (e) => {
        e.preventDefault();
    }

    const getKelas = async () => {
        try {
            let response = await axios.get('/kelas/table');
            setKelas(response.data)
        } catch (e) {
            console.log(e);
        }
    }

    const getDosenBySelectedKelas = async (e) => {
        setKelasId(e.target.value)
        let response = await axios.get(`/jadwals/get-dosen-by-${e.target.value}`)
        setDosens(response.data);
    }

    const getMatkulBySelectedDosen = async (e) => {
        let response = await axios.get(`/jadwals/get-matkul-by-${e.target.value}`)
        setMakuls(response.data)
    } 

    useEffect(() => {
        getKelas()
    },[])
    return (
        <div className="col-12 col-md-6 col-lg-6">
            <div className="card">
                <div className="card-header">
                    <h4>{props.title}</h4>
                </div>
                <div className="card-body">
                    <form className="needs-validation" onSubmit={store}>
                        <div className="form-group">
                            <label htmlFor="kelas">Kelas</label>
                            <select onChange={getDosenBySelectedKelas} name="kelas" id="kelas" className="form-control">
                                <option value={null}>Pilih Kelas</option>
                                {
                                    kelas.map((k) => {
                                        return <option key={k.id} value={k.id}>{k.kd_kelas}</option>
                                    })
                                }
                            </select>
                        </div>

                        {
                            dosens.length ? 
                                <div className="form-group">
                                <label htmlFor="dosen">Dosen</label>
                                <select onChange={getMatkulBySelectedDosen} name="dosen" id="dosen" className="form-control">
                                    <option value={null}>Pilih Dosen</option>
                                    {
                                        dosens.map((dosen) => {
                                            return <option key={dosen.id} value={dosen.id}>{dosen.nama}</option>
                                        })
                                    }
                                </select>
                            </div>
                            :
                            ''
                        }

                        {
                            matkuls.length ? 
                            <div className="form-group">
                            <label htmlFor="matkul">Matakuliah</label>
                            <select name="matkul" id="matkul" className="form-control">
                                <option value={null}>Pilih Matakuliah</option>
                                {
                                    matkuls.map((matkul) => {
                                        return <option key={matkul.id} value={matkul.id}>{matkul.nm_matkul}</option>
                                    })
                                }
                            </select>
                        </div>
                        :
                        ''
                        }
                        <div className="form-group">
                            <button type="submit" className="btn btn-primary btn-lg btn-block">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    );
}

export default FormJadwalKuliah;

if (document.getElementById('jadwal')) {
    var item = document.getElementById('jadwal');
    ReactDOM.render(<FormJadwalKuliah endpoint={item.getAttribute('endpoint')} title={item.getAttribute('title')}/>, item);
}
