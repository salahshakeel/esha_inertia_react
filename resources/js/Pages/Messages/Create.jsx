import InputLabel from '@/Components/InputLabel'
import PrimaryButton from '@/Components/PrimaryButton'
import SecondaryButton from '@/Components/SecondaryButton'
import TextInput from '@/Components/TextInput'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { Head, router, useForm } from '@inertiajs/react'
import React from 'react'

const Create = ({users}) => {

   const { data, setData, post, processing, errors } = useForm({
        email : [],
        message : '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('dashboard.messages.store'));
    };

  return (
    <AuthenticatedLayout
      header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Create New Message</h2>}
    >
        <Head title="Create Book Category" />
        <div className='mx-auto max-w-screen-xl px-4 lg:px-12 py-12'>

            <form onSubmit={submit} className="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
              
                   <div className="mb-6">
                      <InputLabel htmlFor="email" value="Select user" />
                      <select id="email" name="email" className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                      value={data.email}
                      autoFocus
                        onChange={(e) => setData('email', Array.from(e.target.selectedOptions, (option) => option.value))}
                        multiple
                      >
                          {users.map((user) => (
                              <option key={user.id} value={user.email}>
                                  {user.name} ({user.email})
                              </option>
                          ))}
                      </select>

                      {errors.email && <p className="mt-2 text-sm text-red-600">{errors.email}</p>}
                  </div>

                  <div className="mb-6">
                    <InputLabel htmlFor="message" value="Message" />
                    <textarea id="message" name="message" type="text" className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                    value={data.message}
                    autoFocus 
                    onChange={(e) => setData('message', e.target.value)}
                    />

                    {errors.message && <p className="mt-2 text-sm text-red-600">{errors.message}</p>}
                  </div>
          
                <PrimaryButton type="submit" disabled={processing} className="w-full md:w-auto">
                    {processing ? 'Creating...' : 'Create'}
                </PrimaryButton>

                <SecondaryButton className="ml-2" onClick={() => window.history.back()}>Cancel</SecondaryButton>
            </form>

        </div>
    </AuthenticatedLayout>
  )
}

export default Create