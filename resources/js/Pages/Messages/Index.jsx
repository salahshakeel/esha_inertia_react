import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { Head, router } from '@inertiajs/react'
import React from 'react'
import moment from 'moment'
import { Pagination } from '@/Components/Pagination'
import PrimaryButton from '@/Components/PrimaryButton'
const Index = ({ messages }) => {

  return (
    <AuthenticatedLayout
      header={
        <h2 className="font-semibold text-xl text-gray-800 leading-tight">
          Messages
        </h2>
      }
    >
      <Head title="Notifications" />

      <div className="py-8">
        <div className="max-w-5xl mx-auto sm:px-6 lg:px-8">

          <div className="bg-white shadow-sm rounded-lg border border-gray-200">

            {/* Header */}
            <div className="flex items-center justify-between px-6 py-4 border-b">
              <h3 className="text-lg font-semibold text-gray-700">
                Recent Messages
              </h3>

              <PrimaryButton onClick={() => router.visit(route('dashboard.messages.create'))}>
                New Message
              </PrimaryButton>

           
            </div>

            {/* Notifications */}
            <div className="divide-y">

            {messages.data.map((message) => (
              <div key={message.id} className="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 transition">
             
              
                  <div
                    className={`flex items-start gap-4 px-6 py-4 hover:bg-gray-50 transition `}
                  >
                   

                    {/* Content */}
                    <div className="flex-1">
                      <p className="font-medium text-gray-800">
                        {message.name} - {message.email}
                      </p>

                      <p className="text-sm text-gray-600">
                        {message.message}
                      </p>

                      <span className="text-xs text-gray-400">
                        {moment(message.created_at).fromNow()}
                      </span>
                    </div>

                  
                  </div>
                  
              
            </div>

            ))}

          </div>

          </div>

          {/* Pagination */}
          <Pagination data={messages} />


        </div>
      </div>
    </AuthenticatedLayout>
  )
}

export default Index