// import axios from 'axios';
import axios from 'axios';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import toast, { Toaster } from 'react-hot-toast';

function Create(props) {
    //Fecthing data
    const [kelas, setKelas] = useState([])
    const [dosens, setDosens] = useState([])
    const [matkuls, setMakuls] = useState([])
    const [days, setDays] = useState([''])
    const [kelasDoesntHaveJadwal, setKelasDoesntHaveJadwal] = useState([''])

    //untuk mendaptkan value dari inputan
    const [kelasId, setKelasId] = useState('')
    const [dosenId, setDosenId] = useState('')
    const [matkulId, setMatkulId] = useState('')
    const [hari, setHari] = useState('')
    const [jamMasuk, setJamMasuk] = useState('')
    const [jamKeluar, setJamKeluar] = useState('')

    //Notif ketika berhasil create jadwal
    const [errors, setErrors] = useState([''])

    const request = {
        kelas:kelasId,
        dosen:dosenId,
        matkul:matkulId,
        hari,
        jamMasuk,
        jamKeluar
    }

    const store = async (e) => {
        e.preventDefault();
        try {
            let response = await axios.post(props.endpoint, request)
            toast.success(response.data.message);

            setKelasId('')
            setDosenId('')
            setMatkulId('')
            setHari('')
            setJamMasuk('')
            setJamKeluar('')
            setErrors([''])
        } catch (e) {
            setErrors(e.response.data.errors);
        }
    }
    
    const getKelas = async () => {
        try {
            let response = await axios.get('/kelas/table');
            setKelas(response.data)
        } catch (e) {
            console.log(e.message);
        }
    }

    const getDosenBySelectedKelas = async (e) => {
        setKelasId(e.target.value)
        let response = await axios.get(`/jadwals/get-dosen-by-${e.target.value}`)
        setDosens(response.data);
    }

    const getMatkulBySelectedDosen = async (e) => {
        setDosenId(e.target.value)
        let response = await axios.get(`/jadwals/get-matkul-by-${e.target.value}`)
        setMakuls(response.data)
    } 

    const getMatkulId = (e) => {
        setMatkulId(e.target.value)
    }

    const getKelasDoesntHaveJadwal = async e => {
        let response = await axios.get('/jadwals/kelas-mempunyai-jadwal')
        setKelasDoesntHaveJadwal(response.data)
    }

    useEffect((e) => {
        setDays([ 'Senin','Selasa','Rabu','Kamis','Jum\'at', 'Sabtu', 'Minggu' ])
        getKelas()
        getKelasDoesntHaveJadwal()
    },[])
    return (
        <div className="row">
            <div className="col-12 col-md-6 col-lg-6">
            <Toaster
                position="bottom-right"
                reverseOrder={true}
            />
            <div className="card">
                <div className="card-header">
                    <h4>{props.title}</h4>
                </div>
                <div className="card-body">
                    <form onSubmit={store}>
                        <div className="form-group">
                            <label htmlFor="kelas">Kelas</label>
                            <select value={kelasId} onChange={getDosenBySelectedKelas} name="kelas" id="kelas" className="form-control">
                                <option value={null}>Pilih Kelas</option>
                                {
                                    kelas.map((k) => {
                                        return <option key={k.id} value={k.id}>{k.kd_kelas}</option>
                                    })
                                }
                            </select>
                            {
                                errors.kelas ? 
                                <div className="text-danger text-small">{errors.kelas}</div>
                                : ''
                            }
                        </div>

                        {
                            dosens.length ? 
                                <div className="form-group">
                                <label htmlFor="dosen">Dosen</label>
                                <select value={dosenId} onChange={getMatkulBySelectedDosen} name="dosen" id="dosen" className="form-control">
                                    <option value={null}>Pilih Dosen</option>
                                    {
                                        dosens.map((dosen) => {
                                            return <option key={dosen.id} value={dosen.id}>{dosen.nama}</option>
                                        })
                                    }
                                </select>
                                {
                                    errors.dosen ? 
                                    <div className="text-danger text-small">{errors.dosen}</div>
                                    : ''
                                }
                            </div>
                            :
                            ''
                        }

                        {
                            matkuls.length ? 
                            <div className="form-group">
                                <label htmlFor="matkul">Matakuliah</label>
                                <select value={matkulId} onChange={getMatkulId} name="matkul" id="matkul" className="form-control">
                                    <option value={null}>Pilih Matakuliah</option>
                                    {
                                        matkuls.map((matkul) => {
                                            return <option key={matkul.id} value={matkul.id}>{matkul.nm_matkul}</option>
                                        })
                                    }
                                </select>
                                {
                                    errors.matkul ? 
                                    <div className="text-danger text-small">{errors.matkul}</div>
                                    : ''
                                }
                            </div>
                        :
                        ''
                        }

                        <div className="form-group">
                            <label htmlFor="hari">Hari</label>
                            <select value={hari} onChange={e => setHari(e.target.value)} type="text" className="form-control" name="hari" id="hari" >
                                <option value={null}>Pilih Hari</option>
                                {
                                    days.map((day) => {
                                        return <option key={day} value={day}>{day}</option>
                                    })
                                }
                            </select>
                            {
                                errors.hari ? 
                                <div className="text-danger text-small">{errors.hari}</div>
                                : ''
                            }
                        </div>

                        <div className="row">
                            <div className="col">
                                <div className="form-group">
                                    <label htmlFor="jam_masuk">Jam Masuk</label>
                                    <input value={jamMasuk} onChange={e => setJamMasuk(e.target.value)} type="text" className="form-control timepicker" name="jam_masuk" id="jam_masuk" />
                                    {
                                        errors.jamMasuk ? 
                                        <div className="text-danger text-small">{errors.jamMasuk}</div>
                                        : ''
                                    }
                                </div>
                            </div>
                            
                            <div className="col">
                                <div className="form-group">
                                    <label htmlFor="jam_keluar">Jam Keluar</label>
                                    <input value={jamKeluar} onChange={e => setJamKeluar(e.target.value)} type="text" className="form-control timepicker" name="jam_keluar" id="jam_keluar" />
                                    {
                                        errors.jamKeluar ? 
                                        <div className="text-danger text-small">{errors.jamKeluar}</div>
                                        : ''
                                    }
                                </div>
                            </div>
                        </div>

                        <div className="form-group">
                            <button type="submit" className="btn btn-primary btn-lg btn-block">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            {
                kelasDoesntHaveJadwal.length ?
                    <div className="col-12 col-md-6 col-lg-6">
                    <div className="card">
                        <div className="card-header">
                            <h4>Kelas yang belum mempunyai jadwal</h4>
                        </div>
                        <div className="card-body">
                            <table className="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                    kelasDoesntHaveJadwal.map((k) => {
                                        return (
                                            <tr key={k.id}>
                                                <td>{k.id}</td>
                                                <td>{k.kd_kelas}</td>
                                            </tr>
                                        )
                                    })
                                    }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                :
                ''
            }
        </div>
    );
}
export default Create;

if (document.getElementById('jadwal')) {
    var item = document.getElementById('jadwal');
    ReactDOM.render(
                <Create 
                    endpoint={item.getAttribute('endpoint')} 
                    title={item.getAttribute('title')}
                    />, item);
}
